import Point from './point.js';

class RazaoAurea{
    constructor(){
        this.cantoBocaEsq = [0, 0];
        this.cantoBocaDir = [0, 0];
        this.olhoEsq = [0, 0];
        this.olhoDir = [0, 0];
        this.queixo = [0, 0];
        this.baseNariz = [0, 0];
        this.cabelo = [0, 0];
        this.narizEsq = [0, 0];
        this.narizDir = [0, 0];
        this.temporaEsq = [0, 0];
        this.temporaDir = [0, 0];
        this.cantoOlhoDir = [0, 0];
        this.cantoOlhoEsq = [0, 0];
        this.phi = 1,618;

    }

    getPoints(){
        let radius = 1;
        let color = "#00f";
        return [
            new Point(this.cantoBocaEsq[0], this.cantoBocaEsq[1], radius, color),
            new Point(this.cantoBocaDir[0], this.cantoBocaDir[1], radius, color),
            new Point(this.olhoDir[0], this.olhoDir[1], radius, color),
            new Point(this.olhoEsq[0], this.olhoEsq[1], radius, color),
            new Point(this.queixo[0], this.queixo[1], radius, color),
            new Point(this.baseNariz[0], this.baseNariz[1], radius, color),
            new Point(this.cabelo[0], this.cabelo[1], radius, color),
            new Point(this.narizDir[0], this.narizDir[1], radius, color),
            new Point(this.narizEsq[0], this.narizEsq[1], radius, color),
            new Point(this.temporaDir[0], this.temporaDir[1], radius, color),
            new Point(this.temporaEsq[0], this.temporaEsq[1], radius, color),
            new Point(this.cantoOlhoDir[0], this.cantoOlhoDir[1], radius, color),
            new Point(this.cantoOlhoEsq[0], this.cantoOlhoEsq[1], radius, color)
        ]
    }

    drawPoints(canvas){
        for (const point of this.getPoints()){
            point.draw(canvas);
        }
    }
}



export default RazaoAurea;