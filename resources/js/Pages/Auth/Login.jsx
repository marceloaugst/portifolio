import { Head, Link, useForm } from '@inertiajs/react';

export default function Login() {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    function submit(e) {
        e.preventDefault();
        post(route('login'));
    }

    return (
        <div className="relative flex min-h-screen items-center justify-center overflow-hidden bg-slate-950 px-5 text-slate-50">
            <Head title="Login" />

            <div className="pointer-events-none fixed inset-0 z-0 overflow-hidden">
                <div
                    className="absolute -top-1/2 -left-1/2 h-[200%] w-[200%] animate-[bgMove_20s_ease-in-out_infinite]"
                    style={{
                        background:
                            'radial-gradient(circle at 20% 80%, rgba(99,102,241,0.12) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(14,165,233,0.1) 0%, transparent 50%)',
                    }}
                />
            </div>

            <div className="relative z-10 w-full max-w-md rounded-[20px] border border-slate-700 bg-slate-800 p-10">
                <div className="mb-7 text-center">
                    <h2 className="m-0 mb-2 text-2xl font-bold">
                        <i className="fas fa-lock text-indigo-400" /> Login
                    </h2>
                    <p className="m-0 text-sm text-slate-400">Acesse o painel administrativo</p>
                </div>

                <form onSubmit={submit}>
                    <div className="mb-5">
                        <label className="mb-2 block text-sm font-medium">E-mail</label>
                        <input
                            type="email"
                            value={data.email}
                            onChange={(e) => setData('email', e.target.value)}
                            required
                            autoFocus
                            className="w-full rounded-[10px] border border-slate-700 bg-slate-950 px-4 py-3 text-white"
                        />
                        {errors.email && <small className="mt-1 block text-red-400">{errors.email}</small>}
                    </div>

                    <div className="mb-5">
                        <label className="mb-2 block text-sm font-medium">Senha</label>
                        <input
                            type="password"
                            value={data.password}
                            onChange={(e) => setData('password', e.target.value)}
                            required
                            className="w-full rounded-[10px] border border-slate-700 bg-slate-950 px-4 py-3 text-white"
                        />
                        {errors.password && <small className="mt-1 block text-red-400">{errors.password}</small>}
                    </div>

                    <label className="mb-6 flex items-center gap-2 text-sm text-slate-400">
                        <input
                            type="checkbox"
                            checked={data.remember}
                            onChange={(e) => setData('remember', e.target.checked)}
                            className="h-4 w-4 rounded border-slate-700 bg-slate-950"
                        />
                        Lembrar-me
                    </label>

                    <button
                        type="submit"
                        disabled={processing}
                        className="w-full rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 py-3 font-semibold text-white disabled:opacity-60"
                    >
                        {processing ? 'Entrando...' : 'Entrar'}
                    </button>
                </form>

                <div className="mt-5 text-center">
                    <Link href={route('home')} className="text-sm text-slate-400 no-underline hover:text-slate-50">
                        ← Voltar ao portfólio
                    </Link>
                </div>
            </div>
        </div>
    );
}
