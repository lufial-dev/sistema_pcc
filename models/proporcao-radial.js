import Point from './point.js';

class ProporcaoRadial{
    constructor(){
        this.p1 = [0, 0];
        this.p2 = [0, 0];
        this.p3 = [0, 0];
        this.p4 = [0, 0];
        this.p5 = [0, 0];
        this.p6 = [0, 0];
        this.p7 = [0, 0];
        this.p8 = [0, 0];
        this.p9 = [0, 0];
        this.p10 = [0, 0];
        this.p11 = [0, 0];
        this.p12 = [0, 0];
        this.p13 = [0, 0];
        this.p14 = [0, 0];
        this.p15 = [0, 0];
        this.p16 = [0, 0];
        this.p17 = [0, 0];
     }

     calcDis(){
        this.linhaSargital = (this.p16[0] + this.p8[0] + this.p17[0]) / 3;
        
        this.larguraBipuliarDir = this.p4[0] - this.linhaSargital;
        this.larguraBipuliarEsq = this.linhaSargital - this.p3[0];

        this.larguraFacialHorizontalDir = this.p6[0] - this.linhaSargital;
        this.larguraFacialHorizontalEsq = this.linhaSargital - this.p5[0];

        this.larguraNazalDir = this.p9[0] - this.linhaSargital;
        this.larguraNazalEsq = this.linhaSargital - this.p7[0];

        this.larguraLabialDir = this.p12[0] - this.linhaSargital;
        this.larguraLabialEsq = this.linhaSargital - this.p11[0];

        this.larguraFacialVerticalDir = this.p8[1] - this.p16[1];
        this.larguraFacialVerticalEsq = this.p17[1] - this.p8[1];
     }
    getPoints(){
        let radius = 1;
        let color = "#00f";
        return [
            new Point(this.p1[0], this.p1[1], radius, color),
            new Point(this.p2[0], this.p2[1], radius, color),
            new Point(this.p3[0], this.p3[1], radius, color),
            new Point(this.p4[0], this.p4[1], radius, color),
            new Point(this.p5[0], this.p5[1], radius, color),
            new Point(this.p6[0], this.p6[1], radius, color),
            new Point(this.p7[0], this.p7[1], radius, color),
            new Point(this.p8[0], this.p8[1], radius, color),
            new Point(this.p9[0], this.p9[1], radius, color),
            new Point(this.p10[0], this.p10[1], radius, color),
            new Point(this.p11[0], this.p11[1], radius, color),
            new Point(this.p12[0], this.p12[1], radius, color),
            new Point(this.p13[0], this.p13[1], radius, color),
            new Point(this.p14[0], this.p14[1], radius, color),
            new Point(this.p15[0], this.p15[1], radius, color),
            new Point(this.p16[0], this.p16[1], radius, color),
            new Point(this.p17[0], this.p17[1], radius, color),
            
        ]
    }

    drawPoints(canvas){
        for (const point of this.getPoints()){
            point.draw(canvas);
        }
    }

}



export default ProporcaoRadial;