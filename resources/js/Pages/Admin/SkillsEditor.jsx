const categoryLabels = {
    backend: 'Backend',
    frontend: 'Frontend',
    mobile: 'Mobile Development',
    database: 'Banco de Dados',
};

const emptySkill = { name: '', icon: '', color: '#6366f1', url: '' };

export default function SkillsEditor({ skills, onChange }) {
    function updateSkill(category, index, field, value) {
        const items = [...(skills[category] || [])];
        items[index] = { ...items[index], [field]: value };
        onChange({ ...skills, [category]: items });
    }

    function addSkill(category) {
        onChange({ ...skills, [category]: [...(skills[category] || []), { ...emptySkill }] });
    }

    function removeSkill(category, index) {
        onChange({ ...skills, [category]: (skills[category] || []).filter((_, i) => i !== index) });
    }

    return (
        <div className="grid grid-cols-1 gap-6 lg:grid-cols-2">
            {Object.entries(categoryLabels).map(([category, label]) => (
                <div key={category} className="rounded-2xl border border-slate-700 bg-slate-950/40 p-5">
                    <h4 className="m-0 mb-3 text-sm font-semibold text-slate-300">{label}</h4>
                    <div className="flex flex-col gap-3">
                        {(skills[category] || []).map((skill, index) => (
                            <div key={index} className="grid grid-cols-[1fr_1fr_auto] gap-2 rounded-lg bg-slate-900 p-3">
                                <input
                                    type="text"
                                    value={skill.name}
                                    onChange={(e) => updateSkill(category, index, 'name', e.target.value)}
                                    placeholder="Nome (ex: Laravel)"
                                    className="col-span-2 rounded-md border border-slate-700 bg-slate-950 px-2 py-1.5 text-sm text-white"
                                />
                                <button
                                    type="button"
                                    onClick={() => removeSkill(category, index)}
                                    className="row-span-2 flex items-center justify-center rounded-md border border-red-500/40 px-2 text-red-400"
                                    title="Remover skill"
                                >
                                    <i className="fas fa-times" />
                                </button>
                                <input
                                    type="text"
                                    value={skill.icon}
                                    onChange={(e) => updateSkill(category, index, 'icon', e.target.value)}
                                    placeholder="Ícone (ex: fab fa-laravel)"
                                    className="rounded-md border border-slate-700 bg-slate-950 px-2 py-1.5 text-xs text-white"
                                />
                                <input
                                    type="text"
                                    value={skill.url}
                                    onChange={(e) => updateSkill(category, index, 'url', e.target.value)}
                                    placeholder="URL"
                                    className="rounded-md border border-slate-700 bg-slate-950 px-2 py-1.5 text-xs text-white"
                                />
                                <input
                                    type="color"
                                    value={skill.color || '#6366f1'}
                                    onChange={(e) => updateSkill(category, index, 'color', e.target.value)}
                                    className="col-span-2 h-8 w-full rounded-md border border-slate-700 bg-slate-950"
                                />
                            </div>
                        ))}
                    </div>
                    <button
                        type="button"
                        onClick={() => addSkill(category)}
                        className="mt-3 rounded-full border border-slate-700 px-4 py-1.5 text-xs font-medium text-slate-300"
                    >
                        <i className="fas fa-plus" /> Adicionar skill
                    </button>
                </div>
            ))}
        </div>
    );
}
