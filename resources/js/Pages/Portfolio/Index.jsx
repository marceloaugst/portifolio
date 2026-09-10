import { Head, useForm } from '@inertiajs/react';
import { useState } from 'react';
import Layout from '../../Components/Layout';

const experienceItems = [
    {
        period: '2024 — Atual',
        role: 'Desenvolvedor Full Stack',
        company: 'Empresa Atual',
        description: 'Desenvolvimento de aplicações web com Laravel, Golang e React, do backend ao frontend.',
    },
    {
        period: '2022 — 2024',
        role: 'Desenvolvedor Backend',
        company: 'Empresa Anterior',
        description: 'Construção e manutenção de APIs e serviços em Laravel e Golang.',
    },
    {
        period: '2021 — 2022',
        role: 'Desenvolvedor Mobile',
        company: 'Primeira Empresa',
        description: 'Desenvolvimento de apps mobile com Flutter e React Native.',
    },
];

const skillCategoryMeta = {
    backend: { title: 'Backend', icon: 'fas fa-server', color: '#FF2D20' },
    frontend: { title: 'Frontend', icon: 'fas fa-palette', color: '#F7DF1E' },
    mobile: { title: 'Mobile Development', icon: 'fas fa-mobile-alt', color: '#02569B' },
    database: { title: 'Banco de Dados', icon: 'fas fa-database', color: '#336791' },
};

function GradientTitle({ children }) {
    return <span className="bg-gradient-to-br from-indigo-500 to-violet-500 bg-clip-text text-transparent">{children}</span>;
}

function SectionHeading({ pre, highlight, subtitle }) {
    return (
        <>
            <h2 className="m-0 mb-4 text-center text-4xl font-bold">
                {pre} <GradientTitle>{highlight}</GradientTitle>
            </h2>
            {subtitle && <p className="mx-auto mb-14 max-w-xl text-center text-slate-400">{subtitle}</p>}
        </>
    );
}

function ProjectCard({ project }) {
    const [slide, setSlide] = useState(0);
    const shots = project.screenshots || [];
    const hasMultiple = shots.length > 1;

    return (
        <div className="flex flex-col overflow-hidden rounded-[20px] border border-slate-700 bg-slate-800">
            <div className="relative aspect-video bg-slate-950/60">
                {shots.length > 0 ? (
                    <img src={shots[slide]} alt={`Print ${slide + 1} de ${project.name}`} className="absolute inset-0 h-full w-full object-cover" />
                ) : (
                    <div className="absolute inset-0 flex flex-col items-center justify-center gap-2 text-slate-600">
                        <i className="fas fa-image text-4xl" />
                        <span className="text-xs">Print em breve</span>
                    </div>
                )}
                {hasMultiple && (
                    <>
                        <button
                            type="button"
                            onClick={() => setSlide((s) => (s - 1 + shots.length) % shots.length)}
                            className="absolute top-1/2 left-2 z-10 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full border border-slate-700 bg-slate-950/70 text-slate-50"
                        >
                            <i className="fas fa-chevron-left text-xs" />
                        </button>
                        <button
                            type="button"
                            onClick={() => setSlide((s) => (s + 1) % shots.length)}
                            className="absolute top-1/2 right-2 z-10 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full border border-slate-700 bg-slate-950/70 text-slate-50"
                        >
                            <i className="fas fa-chevron-right text-xs" />
                        </button>
                        <div className="absolute right-0 bottom-2.5 left-0 z-10 flex justify-center gap-1.5">
                            {shots.map((_, i) => (
                                <button
                                    key={i}
                                    type="button"
                                    onClick={() => setSlide(i)}
                                    className={`h-2 w-2 rounded-full border-none p-0 ${i === slide ? 'bg-slate-50' : 'bg-slate-50/35'}`}
                                />
                            ))}
                        </div>
                    </>
                )}
            </div>
            <div className="flex flex-1 flex-col gap-2.5 px-6 py-5">
                <h3 className="m-0 text-lg">{project.name}</h3>
                <p className="m-0 flex-1 text-[0.92rem] leading-relaxed text-slate-400">{project.description}</p>
                <a
                    href={project.link}
                    target="_blank"
                    rel="noreferrer"
                    className="mt-2 inline-flex max-w-full items-center gap-2 overflow-hidden rounded-full border border-indigo-500/30 bg-indigo-500/10 px-4 py-2.5 text-sm font-medium text-indigo-300 no-underline"
                >
                    <i className="fas fa-arrow-up-right-from-square flex-shrink-0 text-xs" />
                    <span className="truncate">{project.domain}</span>
                </a>
            </div>
        </div>
    );
}

export default function Index({ name, title, bio, skills, projects, social }) {
    const { data, setData, post, processing, reset, errors } = useForm({
        name: '',
        email: '',
        message: '',
    });
    const [formStatus, setFormStatus] = useState(null); // { type: 'success' | 'error', message: string }

    function submitContact(e) {
        e.preventDefault();
        setFormStatus(null);

        window.axios
            .post(route('contact.send'), data)
            .then((response) => {
                setFormStatus({ type: 'success', message: response.data.message });
                reset();
            })
            .catch((error) => {
                setFormStatus({
                    type: 'error',
                    message: error.response?.data?.message || 'Erro ao enviar a mensagem. Por favor, tente novamente.',
                });
            });

        setTimeout(() => setFormStatus(null), 5000);
    }

    return (
        <>
            <Head title={`${name} - Portfólio`} />

            {/* Hero */}
            <section id="home" className="flex min-h-[calc(100vh-80px)] items-center justify-center px-5 py-20">
                <div className="max-w-3xl text-center">
                    <div className="mb-6 inline-block rounded-full border border-indigo-500/30 bg-indigo-500/10 px-5 py-2 text-sm font-medium text-indigo-300">
                        <i className="fas fa-code" /> {title}
                    </div>
                    <h1 className="m-0 mb-5 text-5xl leading-tight font-bold">
                        Olá, eu sou <GradientTitle>{name}</GradientTitle>
                    </h1>
                    <p className="m-0 mb-7 text-xl text-slate-400">
                        Desenvolvedor Full Stack apaixonado por criar soluções inovadoras com Laravel, Golang, React e JavaScript.
                    </p>
                    <div className="mb-7 flex flex-wrap justify-center gap-4">
                        <a
                            href="#contact"
                            className="inline-flex items-center gap-2.5 rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 px-8 py-3.5 font-semibold text-white no-underline shadow-[0_4px_15px_rgba(99,102,241,0.4)]"
                        >
                            <i className="fas fa-envelope" /> Entre em Contato
                        </a>
                        <a
                            href="#skills"
                            className="inline-flex items-center gap-2.5 rounded-full border-2 border-slate-700 px-8 py-3.5 font-semibold text-slate-50 no-underline"
                        >
                            <i className="fas fa-laptop-code" /> Ver Skills
                        </a>
                    </div>
                </div>
            </section>

            {/* About */}
            <section id="about" className="px-5 py-24">
                <div className="mx-auto max-w-6xl">
                    <SectionHeading pre="Sobre" highlight="Mim" subtitle="Conheça um pouco mais sobre minha trajetória e paixão por desenvolvimento." />
                    <div className="grid grid-cols-1 items-center gap-14 lg:grid-cols-2">
                        <div className="relative mx-auto w-full max-w-[380px]">
                            <div className="aspect-square overflow-hidden rounded-[20px] shadow-[0_10px_40px_rgba(99,102,241,0.3)]">
                                <img src="/img/profile.jpeg" alt={name} className="h-full w-full object-cover" />
                            </div>
                        </div>
                        <div>
                            <h3 className="m-0 mb-4 text-2xl">{title}</h3>
                            <p className="m-0 mb-6 text-[1.05rem] leading-loose text-slate-400">{bio}</p>
                            <div className="grid grid-cols-3 gap-4">
                                {[
                                    ['8+', 'Tecnologias'],
                                    ['∞', 'Curiosidade'],
                                    ['100%', 'Dedicação'],
                                ].map(([number, label]) => (
                                    <div key={label} className="rounded-2xl border border-slate-700 bg-slate-800 px-2.5 py-4 text-center">
                                        <div className="bg-gradient-to-br from-indigo-500 to-violet-500 bg-clip-text text-3xl font-bold text-transparent">
                                            {number}
                                        </div>
                                        <div className="mt-1 text-sm text-slate-400">{label}</div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Experience */}
            <section id="experience" className="bg-slate-900 px-5 py-24">
                <div className="mx-auto max-w-3xl">
                    <SectionHeading pre="Experiência" highlight="Profissional" subtitle="Minha trajetória no desenvolvimento de software." />
                    <div className="flex flex-col">
                        {experienceItems.map((job, i) => (
                            <div key={job.period} className="grid grid-cols-[24px_1fr] gap-5 pb-9">
                                <div className="flex flex-col items-center">
                                    <div className="mt-1 h-3.5 w-3.5 flex-shrink-0 rounded-full bg-gradient-to-br from-indigo-500 to-violet-500" />
                                    {i < experienceItems.length - 1 && <div className="w-0.5 flex-1 bg-slate-700" />}
                                </div>
                                <div className="rounded-2xl border border-slate-700 bg-slate-800 px-6 py-5">
                                    <div className="mb-1.5 text-sm font-semibold text-indigo-300">{job.period}</div>
                                    <h3 className="m-0 mb-1 text-lg">{job.role}</h3>
                                    <div className="mb-2.5 text-slate-400">{job.company}</div>
                                    <p className="m-0 leading-relaxed text-slate-400">{job.description}</p>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Skills */}
            <section id="skills" className="px-5 py-24">
                <div className="mx-auto max-w-6xl">
                    <SectionHeading pre="Minhas" highlight="Skills" subtitle="Tecnologias e ferramentas que domino para criar soluções completas." />
                    <div className="grid grid-cols-1 gap-7 sm:grid-cols-2 lg:grid-cols-4">
                        {Object.entries(skillCategoryMeta).map(([key, meta]) => (
                            <div key={key} className="rounded-[20px] border border-slate-700 bg-slate-800 p-8">
                                <h3 className="m-0 mb-5 flex items-center gap-2.5 text-lg font-semibold">
                                    <i className={meta.icon} style={{ color: meta.color }} />
                                    {meta.title}
                                </h3>
                                <div className="flex flex-col gap-3.5">
                                    {(skills[key] || []).map((skill) => (
                                        <a
                                            key={skill.name}
                                            href={skill.url}
                                            target="_blank"
                                            rel="noreferrer"
                                            className="flex items-center gap-3.5 rounded-xl bg-black/20 p-3.5 text-inherit no-underline"
                                        >
                                            <div
                                                className="flex h-[42px] w-[42px] flex-shrink-0 items-center justify-center rounded-[10px] text-xl"
                                                style={{ background: `${skill.color}20`, color: skill.color }}
                                            >
                                                <i className={skill.icon} />
                                            </div>
                                            <span className="font-medium">{skill.name}</span>
                                        </a>
                                    ))}
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

            {/* Projects */}
            <section id="projects" className="bg-slate-900 px-5 py-24">
                <div className="mx-auto max-w-6xl">
                    <SectionHeading pre="Meus" highlight="Projetos" subtitle="Alguns domínios que mantenho no ar — clique pra visitar." />
                    <div className="grid grid-cols-1 gap-7 sm:grid-cols-2 lg:grid-cols-4">
                        {(projects || []).map((project) => (
                            <ProjectCard key={project.id} project={project} />
                        ))}
                    </div>
                </div>
            </section>

            {/* Contact */}
            <section id="contact" className="px-5 py-24">
                <div className="mx-auto max-w-6xl">
                    <SectionHeading pre="Entre em" highlight="Contato" subtitle="Vamos conversar sobre seu próximo projeto ou oportunidade." />
                    <div className="grid grid-cols-1 gap-14 lg:grid-cols-2">
                        <div>
                            <h3 className="m-0 mb-4 text-2xl">Vamos trabalhar juntos!</h3>
                            <p className="m-0 mb-6 text-slate-400">
                                Estou sempre aberto a discutir novos projetos, ideias criativas ou oportunidades para fazer parte de suas visões.
                            </p>
                            <div className="flex flex-col gap-4">
                                <a
                                    href={social.github}
                                    target="_blank"
                                    rel="noreferrer"
                                    className="flex items-center gap-4 rounded-2xl border border-slate-700 bg-slate-800 p-5 text-slate-50 no-underline"
                                >
                                    <span className="flex h-[50px] w-[50px] flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 text-2xl">
                                        <i className="fab fa-github" />
                                    </span>
                                    <div>
                                        <strong>GitHub</strong>
                                        <p className="m-0 text-sm text-slate-400">Confira meus projetos</p>
                                    </div>
                                </a>
                                <a
                                    href={social.linkedin}
                                    target="_blank"
                                    rel="noreferrer"
                                    className="flex items-center gap-4 rounded-2xl border border-slate-700 bg-slate-800 p-5 text-slate-50 no-underline"
                                >
                                    <span className="flex h-[50px] w-[50px] flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 text-2xl">
                                        <i className="fab fa-linkedin" />
                                    </span>
                                    <div>
                                        <strong>LinkedIn</strong>
                                        <p className="m-0 text-sm text-slate-400">Conecte-se comigo</p>
                                    </div>
                                </a>
                                <a
                                    href={`mailto:${social.email}`}
                                    className="flex items-center gap-4 rounded-2xl border border-slate-700 bg-slate-800 p-5 text-slate-50 no-underline"
                                >
                                    <span className="flex h-[50px] w-[50px] flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 text-2xl">
                                        <i className="fas fa-envelope" />
                                    </span>
                                    <div>
                                        <strong>Email</strong>
                                        <p className="m-0 text-sm text-slate-400">{social.email}</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <form onSubmit={submitContact} className="rounded-[20px] border border-slate-700 bg-slate-800 p-10">
                            <div className="mb-5">
                                <label className="mb-2 block text-sm font-medium">Nome</label>
                                <input
                                    type="text"
                                    value={data.name}
                                    onChange={(e) => setData('name', e.target.value)}
                                    placeholder="Seu nome"
                                    required
                                    className="w-full rounded-[10px] border border-slate-700 bg-slate-950 px-4 py-3.5 font-inherit text-white"
                                />
                                {errors.name && <small className="mt-1 block text-red-400">{errors.name}</small>}
                            </div>
                            <div className="mb-5">
                                <label className="mb-2 block text-sm font-medium">Email</label>
                                <input
                                    type="email"
                                    value={data.email}
                                    onChange={(e) => setData('email', e.target.value)}
                                    placeholder="seu@email.com"
                                    required
                                    className="w-full rounded-[10px] border border-slate-700 bg-slate-950 px-4 py-3.5 font-inherit text-white"
                                />
                                {errors.email && <small className="mt-1 block text-red-400">{errors.email}</small>}
                            </div>
                            <div className="mb-6">
                                <label className="mb-2 block text-sm font-medium">Mensagem</label>
                                <textarea
                                    value={data.message}
                                    onChange={(e) => setData('message', e.target.value)}
                                    placeholder="Sua mensagem..."
                                    required
                                    rows={4}
                                    className="w-full resize-y rounded-[10px] border border-slate-700 bg-slate-950 px-4 py-3.5 font-inherit text-white"
                                />
                                {errors.message && <small className="mt-1 block text-red-400">{errors.message}</small>}
                            </div>
                            <button
                                type="submit"
                                disabled={processing}
                                className="flex w-full items-center justify-center gap-2.5 rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 px-8 py-3.5 font-semibold text-white disabled:opacity-60"
                            >
                                <i className="fas fa-paper-plane" /> {processing ? 'Enviando...' : 'Enviar Mensagem'}
                            </button>
                            {formStatus && (
                                <div
                                    className={`mt-4 rounded-lg p-3 text-center text-sm ${
                                        formStatus.type === 'success'
                                            ? 'border border-green-500/30 bg-green-500/10 text-green-400'
                                            : 'border border-red-500/30 bg-red-500/10 text-red-400'
                                    }`}
                                >
                                    <i className={formStatus.type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle'} />{' '}
                                    {formStatus.message}
                                </div>
                            )}
                        </form>
                    </div>
                </div>
            </section>
        </>
    );
}

Index.layout = (page) => <Layout>{page}</Layout>;
