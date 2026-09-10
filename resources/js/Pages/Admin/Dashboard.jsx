import { Head, Link, useForm, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import AddProjectForm from './AddProjectForm';
import ProjectRow from './ProjectRow';
import SkillsEditor from './SkillsEditor';

export default function Dashboard({ config, projects }) {
    const { auth, flash } = usePage().props;
    const { data, setData, put, processing, errors } = useForm({
        name: config.name,
        title: config.title,
        bio: config.bio,
        skills: config.skills,
    });
    const [showSuccess, setShowSuccess] = useState(Boolean(flash?.success));

    useEffect(() => {
        if (flash?.success) {
            setShowSuccess(true);
            const timer = setTimeout(() => setShowSuccess(false), 5000);
            return () => clearTimeout(timer);
        }
    }, [flash?.success]);

    function submit(e) {
        e.preventDefault();
        put(route('admin.update'));
    }

    const skillCount = Object.values(config.skills || {}).reduce((total, items) => total + items.length, 0);

    return (
        <div className="min-h-screen bg-slate-950 text-slate-50">
            <Head title="Painel Administrativo" />

            <nav className="border-b border-slate-700 bg-slate-900">
                <div className="mx-auto flex max-w-6xl items-center justify-between px-5 py-4">
                    <span className="flex items-center gap-2 text-lg font-semibold">
                        <i className="fas fa-user-shield text-indigo-400" /> Painel Administrativo
                    </span>
                    <div className="flex items-center gap-4">
                        <span className="text-sm text-slate-400">
                            <i className="fas fa-user-circle" /> {auth.user?.name}
                        </span>
                        <Link
                            href={route('logout')}
                            method="post"
                            as="button"
                            className="rounded-full border border-slate-700 px-4 py-1.5 text-sm text-slate-300"
                        >
                            <i className="fas fa-sign-out-alt" /> Sair
                        </Link>
                    </div>
                </div>
            </nav>

            <div className="mx-auto max-w-6xl px-5 py-10">
                <div className="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-3">
                    {[
                        ['fas fa-user', 'Perfil', config.name],
                        ['fas fa-briefcase', 'Cargo', config.title],
                        ['fas fa-star', 'Skills', `${skillCount} cadastradas`],
                    ].map(([icon, label, value]) => (
                        <div key={label} className="flex items-center gap-4 rounded-2xl border border-slate-700 bg-slate-800 p-5">
                            <div className="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 text-xl">
                                <i className={icon} />
                            </div>
                            <div>
                                <h3 className="m-0 text-sm text-slate-400">{label}</h3>
                                <p className="m-0 font-medium">{value}</p>
                            </div>
                        </div>
                    ))}
                </div>

                {showSuccess && flash?.success && (
                    <div className="mb-6 rounded-lg border border-green-500/30 bg-green-500/10 px-4 py-3 text-green-400">
                        <i className="fas fa-check-circle" /> {flash.success}
                    </div>
                )}

                <div className="mb-8 rounded-[20px] border border-slate-700 bg-slate-800">
                    <div className="border-b border-slate-700 px-6 py-4 font-semibold">
                        <i className="fas fa-edit" /> Editar Informações do Portfólio
                    </div>
                    <form onSubmit={submit} className="flex flex-col gap-6 p-6">
                        <div>
                            <h5 className="m-0 mb-4 flex items-center gap-2 text-sm font-semibold text-slate-300">
                                <i className="fas fa-id-card" /> Informações Pessoais
                            </h5>
                            <div className="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <label className="mb-1 block text-sm font-medium">
                                        <i className="fas fa-user" /> Nome Completo
                                    </label>
                                    <input
                                        type="text"
                                        value={data.name}
                                        onChange={(e) => setData('name', e.target.value)}
                                        required
                                        className="w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-white"
                                    />
                                    {errors.name && <small className="mt-1 block text-red-400">{errors.name}</small>}
                                </div>
                                <div>
                                    <label className="mb-1 block text-sm font-medium">
                                        <i className="fas fa-briefcase" /> Título Profissional
                                    </label>
                                    <input
                                        type="text"
                                        value={data.title}
                                        onChange={(e) => setData('title', e.target.value)}
                                        required
                                        className="w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-white"
                                    />
                                    {errors.title && <small className="mt-1 block text-red-400">{errors.title}</small>}
                                </div>
                            </div>
                        </div>

                        <div>
                            <h5 className="m-0 mb-4 flex items-center gap-2 text-sm font-semibold text-slate-300">
                                <i className="fas fa-align-left" /> Sobre Você
                            </h5>
                            <label className="mb-1 block text-sm font-medium">
                                <i className="fas fa-pen" /> Biografia
                            </label>
                            <textarea
                                value={data.bio}
                                onChange={(e) => setData('bio', e.target.value)}
                                rows={6}
                                required
                                className="w-full resize-y rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-white"
                            />
                            <small className="mt-1 block text-slate-500">
                                <i className="fas fa-info-circle" /> Descreva sua experiência, habilidades e objetivos profissionais
                            </small>
                            {errors.bio && <small className="mt-1 block text-red-400">{errors.bio}</small>}
                        </div>

                        <div>
                            <h5 className="m-0 mb-4 flex items-center gap-2 text-sm font-semibold text-slate-300">
                                <i className="fas fa-star" /> Habilidades Técnicas
                            </h5>
                            <SkillsEditor skills={data.skills} onChange={(skills) => setData('skills', skills)} />
                        </div>

                        <div className="flex flex-wrap gap-3 border-t border-slate-700 pt-5">
                            <Link
                                href={route('home')}
                                className="rounded-full border border-slate-700 px-5 py-2.5 text-sm font-semibold text-slate-300 no-underline"
                            >
                                <i className="fas fa-eye" /> Visualizar Portfólio
                            </Link>
                            <button
                                type="submit"
                                disabled={processing}
                                className="rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 px-5 py-2.5 text-sm font-semibold text-white disabled:opacity-60"
                            >
                                <i className="fas fa-save" /> Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>

                <div className="rounded-[20px] border border-slate-700 bg-slate-800">
                    <div className="border-b border-slate-700 px-6 py-4 font-semibold">
                        <i className="fas fa-diagram-project" /> Gerenciar Projetos
                    </div>
                    <div className="flex flex-col gap-6 p-6">
                        {projects.map((project) => (
                            <ProjectRow key={project.id} project={project} />
                        ))}
                        <AddProjectForm />
                    </div>
                </div>
            </div>
        </div>
    );
}
