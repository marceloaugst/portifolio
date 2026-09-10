import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';

const navLinks = [
    { href: '#home', label: 'Início' },
    { href: '#about', label: 'Sobre' },
    { href: '#experience', label: 'Experiência' },
    { href: '#skills', label: 'Skills' },
    { href: '#projects', label: 'Projetos' },
    { href: '#contact', label: 'Contato' },
];

export default function Layout({ children }) {
    const { auth } = usePage().props;
    const [menuOpen, setMenuOpen] = useState(false);

    const authLink = auth?.user ? (
        <Link
            href={route('admin.dashboard')}
            className="text-sm font-medium text-slate-400 no-underline transition-colors hover:text-slate-50"
        >
            Admin
        </Link>
    ) : (
        <Link href={route('login')} className="text-sm font-medium text-slate-400 no-underline transition-colors hover:text-slate-50">
            Login
        </Link>
    );

    return (
        <div className="relative min-h-screen overflow-x-hidden bg-slate-950 text-slate-50">
            <div className="pointer-events-none fixed inset-0 z-0 overflow-hidden">
                <div
                    className="absolute -top-1/2 -left-1/2 h-[200%] w-[200%] animate-[bgMove_20s_ease-in-out_infinite]"
                    style={{
                        background:
                            'radial-gradient(circle at 20% 80%, rgba(99,102,241,0.12) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(14,165,233,0.1) 0%, transparent 50%), radial-gradient(circle at 40% 40%, rgba(139,92,246,0.06) 0%, transparent 40%)',
                    }}
                />
            </div>

            <header className="fixed inset-x-0 top-0 z-50 border-b border-slate-700 bg-slate-950/80 backdrop-blur-xl">
                <div className="mx-auto flex max-w-6xl items-center justify-between gap-4 px-5 py-[18px]">
                    <a
                        href="#home"
                        className="bg-gradient-to-br from-indigo-500 to-violet-500 bg-clip-text text-[1.4rem] font-bold text-transparent"
                    >
                        MA
                    </a>

                    <nav className="hidden md:block">
                        <ul className="flex flex-wrap items-center gap-6">
                            {navLinks.map((link) => (
                                <li key={link.href}>
                                    <a
                                        href={link.href}
                                        className="text-sm font-medium text-slate-400 no-underline transition-colors hover:text-slate-50"
                                    >
                                        {link.label}
                                    </a>
                                </li>
                            ))}
                            <li>{authLink}</li>
                        </ul>
                    </nav>

                    <button
                        type="button"
                        onClick={() => setMenuOpen((open) => !open)}
                        className="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-700 text-slate-300 md:hidden"
                        aria-label="Abrir menu"
                    >
                        <i className={menuOpen ? 'fas fa-times' : 'fas fa-bars'} />
                    </button>
                </div>

                {menuOpen && (
                    <nav className="border-t border-slate-700 bg-slate-950/95 px-5 py-4 md:hidden">
                        <ul className="flex flex-col gap-4">
                            {navLinks.map((link) => (
                                <li key={link.href}>
                                    <a
                                        href={link.href}
                                        onClick={() => setMenuOpen(false)}
                                        className="text-sm font-medium text-slate-400 no-underline transition-colors hover:text-slate-50"
                                    >
                                        {link.label}
                                    </a>
                                </li>
                            ))}
                            <li onClick={() => setMenuOpen(false)}>{authLink}</li>
                        </ul>
                    </nav>
                )}
            </header>

            <main className="relative z-10 mt-20">{children}</main>

            <footer className="relative z-10 border-t border-slate-700 bg-slate-900 px-5 py-10 text-center text-slate-400">
                <div className="flex flex-col items-center gap-3">
                    <p className="m-0 text-sm">
                        &copy; {new Date().getFullYear()} Marcelo Augusto Alves Farias. Todos os direitos reservados.
                    </p>
                    <div className="flex items-center gap-2.5 text-sm">
                        <i className="fab fa-react animate-[pulseIcon_2s_ease-in-out_infinite] text-[1.3rem] text-[#61dafb]" />
                        <span>
                            Refeito em <strong className="text-[#61dafb]">React</strong>
                        </span>
                    </div>
                </div>
            </footer>
        </div>
    );
}
