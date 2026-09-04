// Client-side auth wiring for rc_website (SSO edition).
//
// Login / register / forgot are handled by Supabase (the single identity
// provider) directly from the browser, which sets the shared session cookie.
// This module is loaded on every page (via the layout) so it can also:
//   - keep the shared cookie fresh (autoRefreshToken on the client), and
//   - intercept logout forms to sign out of Supabase (clearing the shared
//     cookie + broadcasting SIGNED_OUT to other tabs) before hitting Laravel.
import { supabase } from './supabase';

window.rcSupabase = supabase;

function redirectAfterAuth() {
    const params = new URLSearchParams(window.location.search);
    window.location.href = params.get('redirect') || '/';
}

function showError(msg) {
    const el = document.getElementById('rc-auth-error');
    if (el) {
        el.textContent = msg;
        el.classList.remove('hidden');
    }
}

function clearError() {
    const el = document.getElementById('rc-auth-error');
    if (el) {
        el.textContent = '';
        el.classList.add('hidden');
    }
}

function setBusy(form, busy) {
    const btn = form.querySelector('button[type="submit"]');
    if (btn) {
        btn.disabled = busy;
        btn.classList.toggle('opacity-60', busy);
        btn.classList.toggle('cursor-not-allowed', busy);
    }
}

// --- Global logout interceptor -------------------------------------------
document.addEventListener('submit', async (e) => {
    const form = e.target;
    if (!(form instanceof HTMLFormElement)) return;
    const action = form.getAttribute('action') || '';
    if (!/\/logout\/?$/.test(action)) return;
    if (form.dataset.ssoDone) return; // second pass -> let it submit natively

    e.preventDefault();
    try {
        await supabase.auth.signOut();
    } catch (_) {
        /* ignore — server will still clear its session */
    }
    form.dataset.ssoDone = '1';
    form.submit();
});

// --- Login ----------------------------------------------------------------
const loginForm = document.getElementById('rc-login-form');
if (loginForm) {
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        clearError();
        const email = loginForm.email.value.trim();
        const password = loginForm.password.value;
        setBusy(loginForm, true);
        const { error } = await supabase.auth.signInWithPassword({ email, password });
        setBusy(loginForm, false);
        if (error) return showError(error.message);
        redirectAfterAuth();
    });
}

// --- Register -------------------------------------------------------------
const registerForm = document.getElementById('rc-register-form');
if (registerForm) {
    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        clearError();
        const email = registerForm.email.value.trim();
        const password = registerForm.password.value;
        const name = registerForm.name ? registerForm.name.value.trim() : '';
        const phone = registerForm.phone ? registerForm.phone.value.trim() : '';
        setBusy(registerForm, true);
        const { data, error } = await supabase.auth.signUp({
            email,
            password,
            // Set BOTH `name` and `full_name`: RoboHub's handle_new_user trigger
            // reads `name`, other apps read `full_name` (same convention the
            // sso-migration script uses). Missing `name` => profile named "User".
            options: { data: { name, full_name: name, phone_number: phone } },
        });
        setBusy(registerForm, false);
        if (error) return showError(error.message);
        if (!data.session) {
            // Email confirmation is enabled -> no session yet.
            showError('Check your email to confirm your account, then sign in.');
            return;
        }
        redirectAfterAuth();
    });
}

// --- Forgot password ------------------------------------------------------
const forgotForm = document.getElementById('rc-forgot-form');
if (forgotForm) {
    forgotForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        clearError();
        const email = forgotForm.email.value.trim();
        setBusy(forgotForm, true);
        const { error } = await supabase.auth.resetPasswordForEmail(email, {
            redirectTo: window.location.origin + '/reset-password',
        });
        setBusy(forgotForm, false);
        if (error) return showError(error.message);
        const ok = document.getElementById('rc-auth-success');
        if (ok) ok.classList.remove('hidden');
    });
}
