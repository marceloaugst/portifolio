import { router, useForm } from '@inertiajs/react';
import { useRef } from 'react';

export default function ProjectRow({ project }) {
    const { data, setData, put, processing, errors } = useForm({
        name: project.name,
        domain: project.domain,
        link: project.link,
        description: project.description,
    });

    const uploadForm = useForm({ screenshot: null });
    const fileInput = useRef(null);

    function saveProject(e) {
        e.preventDefault();
        put(route('admin.projects.update', project.id));
    }

    function uploadScreenshot(e) {
        const file = e.target.files?.[0];
        if (!file) return;

        uploadForm.setData('screenshot', file);
        uploadForm.post(route('admin.projects.screenshots.store', project.id), {
            forceFormData: true,
            preserveScroll: true,
            onSuccess: () => {
                uploadForm.reset();
                if (fileInput.current) fileInput.current.value = '';
            },
        });
    }

    function removeScreenshot(path) {
        router.delete(route('admin.projects.screenshots.destroy', project.id), {
            data: { path },
            preserveScroll: true,
        });
    }

    function removeProject() {
        if (!confirm(`Remover o projeto "${project.name}"? Isso apaga os prints também.`)) return;
        router.delete(route('admin.projects.destroy', project.id), { preserveScroll: true });
    }

    return (
        <div className="rounded-2xl border border-slate-700 bg-slate-950/40 p-6">
            <form onSubmit={saveProject} className="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label className="mb-1 block text-xs font-medium text-slate-400">Nome</label>
                    <input
                        type="text"
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
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
                        className="w-full resize-y rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-white"
                    />
                    {errors.description && <small className="text-red-400">{errors.description}</small>}
                </div>
                <div className="flex gap-3 sm:col-span-2">
                    <button
                        type="submit"
                        disabled={processing}
                        className="rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 px-5 py-2 text-sm font-semibold text-white disabled:opacity-60"
                    >
                        Salvar projeto
                    </button>
                    <button
                        type="button"
                        onClick={removeProject}
                        className="rounded-full border border-red-500/40 px-5 py-2 text-sm font-semibold text-red-400"
                    >
                        <i className="fas fa-trash" /> Remover projeto
                    </button>
                </div>
            </form>

            <div className="mt-5 border-t border-slate-700 pt-5">
                <label className="mb-2 block text-xs font-medium text-slate-400">Prints ({project.screenshots.length})</label>
                <div className="mb-3 flex flex-wrap gap-3">
                    {project.screenshots.map((shot) => (
                        <div key={shot.path} className="group relative h-20 w-32 overflow-hidden rounded-lg border border-slate-700">
                            <img src={shot.url} alt="" className="h-full w-full object-cover" />
                            <button
                                type="button"
                                onClick={() => removeScreenshot(shot.path)}
                                className="absolute top-1 right-1 flex h-6 w-6 items-center justify-center rounded-full bg-slate-950/80 text-xs text-red-400 opacity-0 transition-opacity group-hover:opacity-100"
                                title="Remover print"
                            >
                                <i className="fas fa-times" />
                            </button>
                        </div>
                    ))}
                    {project.screenshots.length === 0 && <p className="text-sm text-slate-500">Nenhum print enviado ainda.</p>}
                </div>
                <label className="inline-flex cursor-pointer items-center gap-2 rounded-full border border-slate-700 px-4 py-2 text-sm text-slate-300">
                    <i className="fas fa-upload" />
                    {uploadForm.processing ? 'Enviando...' : 'Adicionar print'}
                    <input ref={fileInput} type="file" accept="image/*" onChange={uploadScreenshot} className="hidden" />
                </label>
                {uploadForm.errors.screenshot && <small className="mt-1 block text-red-400">{uploadForm.errors.screenshot}</small>}
            </div>
        </div>
    );
}
