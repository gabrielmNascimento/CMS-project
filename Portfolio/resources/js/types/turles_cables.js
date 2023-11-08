export const TurlesCables = [
    {id: 1, option: 'Fiber Ornitorrinco'},
    {id: 2, option: 'Cable Cage'},
    {id: 3, option: 'Cabo de Rede'},
    {id: 4, option: 'CCE/Drop'},
    {id: 5, option: 'FE'},
    {id: 6, option: 'Pluma Metal'},
    {id: 7, option: 'Maxine'},
    {id: 8, option: 'Cable Anil'},
    {id: 9, option: 'UTP'},
    {id: 10, option: 'Imperador'},
    {id: 11, option: 'Boca sem uso'},
    {id: 12, option: 'DROP'},
    {id: 13, option: 'Colar Salsa'},
    {id: 14, option: 'Crina Sala'},
    {id: 15, option: 'Radio'},
    {id: 999, option: 'Outro'},
]

export const getTurles = (id) => {
    let turles = TurlesCables.find(e => e.id === id)
    return turles ? turles.option : '--'
}
