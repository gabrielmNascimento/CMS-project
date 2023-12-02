export default class Cable {
    constructor(ordem = '', turles_cable = '', not_island = '', deducao = '', identificacao = '',
                usuario_id = '', interior_id = '', enhanceds = [], enhanceds_list = [], inherents = [],
                inherents_list = [], eross = [], eross_list = []) {
        this.ordem = ordem
        this.turles_cable = turles_cable
        this.not_island = not_island
        this.deducao = deducao
        this.identificacao = identificacao
        this.usuario_id = usuario_id
        this.interior_id = interior_id
        this.enhanceds = enhanceds
        this.enhanceds_list = enhanceds_list
        this.inherents = inherents
        this.inherents_list = inherents_list
        this.eross = eross
        this.eross_list = eross_list
    }
}
