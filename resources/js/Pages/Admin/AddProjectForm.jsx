import { useForm } from '@inertiajs/react';

export default function AddProjectForm() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        domain: '',
        link: '',
        description: '',
    });

    function submit(e) {
        e.preventDefault();
        post(route('admin.projects.store'), {
            preserveScroll: true,
            onSuccess: () => reset(),
        });
    }

    return (
        <form onSubmit={submit} className="grid grid-cols-1 gap-4 rounded-2xl border border-dashed border-slate-700 p-6 sm:grid-cols-2">
            <div>
                <label className="mb-1 block text-xs font-medium text-slate-400">Nome</label>
                <input
                    type="text"
                    value={data.name}
                    onChange={(e) => setData('name', e.target.value)}
                    placeholder="Ex: Meu Projeto"
                    className="w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-white"
                />
                {errors.name && <small className="text-red-400">{errors.name}</small>}
            </div>
            <div>
                <label className="mb-1 block text-xs font-medium text-slate-400">Domínio</label>
                <input
                    type="text"
                    value={data.domain}
                    onChange={(e) => setData('domain', e.target.value)}
                    placeholder="meuprojeto.dev.br"
                    className="w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-white"
                />
                {errors.domain && <small className="text-red-400">{errors.domain}</small>}
            </div>
            <div>
                <label className="mb-1 block text-xs font-medium text-slate-400">Link</label>
                <input
                    type="text"
                    value={data.link}
                    onChange={(e) => setData('link', e.target.value)}
                    placeholder="https://meuprojeto.dev.br"
                    className="w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-white"
                />
                {errors.link && <small className="text-red-400">{errors.link}</small>}
            </div>
            <div className="sm:col-span-2">
                <label className="mb-1 block text-xs font-medium text-slate-400">Descrição</label>
                <textarea
                    value={data.description}
                    onChange={(e) => setData('description', e.target.value)}
                    rows={2}
                    placeholder="Sobre o que é o projeto..."
                    className="w-full resize-y rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-white"
                />
                {errors.description && <small className="text-red-400">{errors.description}</small>}
            </div>
            <div className="sm:col-span-2">
                <button
                    type="submit"
                    disabled={processing}
                    className="rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 px-5 py-2 text-sm font-semibold text-white disabled:opacity-60"
                >
                    <i className="fas fa-plus" /> Adicionar Projeto
                </button>
            </div>
        </form>
    );
}
