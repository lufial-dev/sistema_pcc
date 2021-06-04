import Point from './point.js';

class AVC{
    constructor(){
        this.sobrancelhaEsq = [0, 0];
        this.sobrancelhaDir = [0, 0];
        this.testaEsq = [0, 0];
        this.testaDir = [0, 0];
    }

    getPoints(){
        let radius = 1;
        let color = "#00f";
        return [
            new Point(this.sobrancelhaEsq[0], this.sobrancelhaEsq[1], radius, color),
            new Point(this.sobrancelhaDir[0], this.sobrancelhaDir[1], radius, color),
            new Point(this.testaEsq[0], this.testaEsq[1], radius, color),
            new Point(this.testaDir[0], this.testaDir[1], radius, color)
        ]
    }

    drawPoints(canvas){
        for (const point of this.getPoints()){
            point.draw(canvas);
        }
    }
}



export default AVC;