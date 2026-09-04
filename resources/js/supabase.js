// Shared Supabase browser client for rc_website (SSO edition).
//
// Uses @supabase/ssr cookie storage so a login here writes the SAME
// `sb-<ref>-auth-token` cookie that RoboHub / connected-labs / roboagentweb
// read, and that the Laravel SupabaseAuth middleware verifies server-side.
// Keep the cookie options byte-identical with the other apps.
import { createBrowserClient } from '@supabase/ssr';

const url = import.meta.env.VITE_SUPABASE_URL;
const anonKey = import.meta.env.VITE_SUPABASE_ANON_KEY;

const isHttps = typeof window !== 'undefined' && window.location.protocol === 'https:';

export const supabase = createBrowserClient(url, anonKey, {
    cookieOptions: {
        path: '/',
        sameSite: 'lax',
        secure: isHttps,
    },
    auth: {
        flowType: 'pkce',
        persistSession: true,
        autoRefreshToken: true,
        detectSessionInUrl: true,
    },
});
