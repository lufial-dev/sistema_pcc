import Face from '../models/face.js';
import CaptureController from './capture_controller.js';

class AppController{
    constructor({canvas, canvasElement, textInstruction, buttonShowLandmarksPoints, buttonShowNottinghamPoints, buttonStart, divResults}){
        this.canvasCtx = canvas;
        this.canvasElement = canvasElement;
        this.width = canvasElement.width;
        this.height = canvasElement.height;
        this.textInstruction = textInstruction;
        this.isShowNottinghamPoints = false;
        this.isShowLandmarksPoints = false;
        this.buttonShowLandmarksPoints = buttonShowLandmarksPoints,
        this.buttonShowNottinghamPoints = buttonShowNottinghamPoints,
        this.isShowCenterFace = false;
        this.divResults = divResults,
        this.face = new Face();
        this.position = 0;
        this.faces = [];
        this.isCenterFace = false;
        this.isStart = false;
        this.texts = [
            "Mantenha o rosto em repouso e evite movimentos bruscos",
            "Levante as Sobrancelhas",
            "Sorria",
            "Precione os olhos com força"
        ];
        this.captureController = new CaptureController({face : this.face, textInstruction : this.textInstruction, texts : this.texts, faces : this.faces, buttonStart : buttonStart, divResults : divResults});
        
    }   

    flip(){
        this.canvasCtx.translate(this.canvasElement.width, 0);
        this.canvasCtx.scale(-1, 1);
    }

    start(){
        //this.divResults.innerHTML = "";
        this.captureController.captures = [];
        this.textInstruction.innerHTML = this.texts[0];
        this.captureController.isCaptured = true;
        document.getElementById("button-start-capture").style.display = "none";
        document.getElementById("status").style.display = "flex";
        document.getElementById("menu-capture").style.display = "flex";
        document.getElementById("roll").click();
        //this.isShowCenterFace = true;
    }

    setShowLandmarksPoints(){
        this.isShowLandmarksPoints = !this.isShowLandmarksPoints;
        if(this.isShowLandmarksPoints)
          this.buttonShowLandmarksPoints.innerHTML = "Ocultar Pontos Faciais"
        else
          this.buttonShowLandmarksPoints.innerHTML = "Mostrar Pontos Faciais"
    }

    setShowNottinghamPoints(){
        this.isShowNottinghamPoints = !this.isShowNottinghamPoints; 
        if(this.isShowNottinghamPoints)
          this.buttonShowNottinghamPoints.innerHTML = "Ocultar Pontos de Nottingham";
        else
          this.buttonShowNottinghamPoints.innerHTML = "Mostrar Pontos de Nottingham";
    }

    verifyCenter(contorno, button){
        var contorno = document.getElementById("contorno-img");
        var button = document.getElementById("button-start-capture");
        if(!this.isStart){
            document.getElementById("load-camera").style.display = "none";
            this.textInstruction.innerHTML = "Mantenha o roesto centralizado";
            contorno.style.display = "block";
            this.isStart = true;
        }
        var posXDir = this.face.getXbyId(234);
        var posXEsq = this.face.getXbyId(454);
        if(posXDir > 120 && posXDir < 220 && posXEsq > 480 && posXEsq < 560 ){
            contorno.src = "views/assets/images/contorno-verde.png";
            button.style.backgroundColor = "#780FA9";
            button.disabled = "";
            
        } else{
            contorno.src = "views/assets/images/contorno-vermelho.png";
            button.style.backgroundColor = "#777877";
            button.disabled = "disabled";
        }

    }
    
    onResults(results, camera) {
        this.canvasCtx.save();
        this.flip();
        this.verifyCenter();


        this.canvasCtx.clearRect(0, 0,this.canvasElement.width, this.canvasElement.height);
        this.canvasCtx.drawImage(results.image, 0, 0, this.canvasElement.width, this.canvasElement.height);
        if (results.multiFaceLandmarks) {
        
            this.face = new Face(); 
            for (const landmarks of results.multiFaceLandmarks) {
                
                this.face.setLandmarks(landmarks, this.width, this.height);   
                //this.showCenterFace(results.image);            
                this.showLandmarksPoints(this.face.landmarks);
                this.getNottinghamPositions(this.face);
                this.getRadialPositions(this.face);
                this.getAureaPositions(this.face);
                this.getAVCPositions(this.face);
                this.showRadialPoints(this.face);
                this.showAureaPoints(this.face);
                this.showNottinghamPoints(this.face);  
                this.showAVCPoints(this.face);  
                
            }
            this.captureController.face = this.face;
            this.addFace();   
            if(this.captureController.isCaptured)
                this.captureController.startCapture(results.image, camera);

            for(const land of this.face.landmarks){
                this.canvasCtx.fillText(land.number, land.x, land.y);
            }
            
            this.canvasCtx.restore();
            
        }
        
    }

    addFace(){
        if(this.position == 10)
            this.faces[0] = this.face;
        if(this.position == 40){
            this.faces[1] = this.face;
            this.position = 0;
        }
        this.position += 1;
    }

    showLandmarksPoints(landmarks){
        if(this.isShowLandmarksPoints)
            for(const land of landmarks){
                land.point.draw(this.canvasCtx);
            }
    }

    // showCenterFace(canvas){
    //     if(this.isShowCenterFace){
    //         if(this.isCenterFace)
    //             this.canvasCtx.fillStyle = 'rgba(0,120,0,0.5)';
    //         else
    //             this.canvasCtx.fillStyle = 'rgba(0,0,120,0.5)';
    //             this.canvasCtx.scale(1,1);
    //             this.canvasCtx.fillRect(0,0, this.canvasElement.width, this.canvasElement.height);
    //             this.canvasCtx.ellipse(this.canvasElement.width / 2, this.canvasElement.height / 2, 230, 300, 0, 0, Math.PI*2);
    //             //this.canvasCtx.arc(this.canvasElement.width / 2, this.canvasElement.height / 2, 300, 0, Math.PI * 2, true);
    //             this.canvasCtx.clip();
    //             this.canvasCtx.scale(1,1);
    //             this.canvasCtx.drawImage(canvas, 0, 0, this.canvasElement.width, this.canvasElement.height);
        
            
    //     }
    // }

    showNottinghamPoints(face){
        if(this.isShowNottinghamPoints)
            face.nottingham.drawPoints(this.canvasCtx);
    }

    showRadialPoints(face){
        if(this.isShowNottinghamPoints)
            face.radial.drawPoints(this.canvasCtx);
    }

    showAureaPoints(face){
        if(this.isShowNottinghamPoints)
            face.aurea.drawPoints(this.canvasCtx);
    }

    showAVCPoints(face){
        //if(this.isShowNottinghamPoints)
            face.avc.drawPoints(this.canvasCtx);
    }

    getAureaPositions(face){
        face.aurea.cantoBocaDir = [face.getXbyId(61), face.getYbyId(61)];
        face.aurea.cantoBocaEsq = [face.getXbyId(291), face.getYbyId(291)];
        face.aurea.olhoDir = [face.getXbyId(23), face.getYbyId(23)];
        face.aurea.olhoEsq = [face.getXbyId(253), face.getYbyId(253)];
        face.aurea.queixo = [face.getXbyId(152), face.getYbyId(152)];
        face.aurea.baseNariz = [face.getXbyId(2), face.getYbyId(2)];
        face.aurea.cabelo = [face.getXbyId(10), face.getYbyId(10)];
        face.aurea.narizEsq = [face.getXbyId(49), face.getYbyId(49)];
        face.aurea.narizDir = [face.getXbyId(279), face.getYbyId(279)];
        face.aurea.temporaEsq = [face.getXbyId(368), face.getYbyId(368)];
        face.aurea.temporaDir = [face.getXbyId(139), face.getYbyId(139)];
        face.aurea.cantoOlhoDir = [face.getXbyId(33), face.getYbyId(33)];
        face.aurea.cantoOlhoEsq = [face.getXbyId(263), face.getYbyId(263)];
        
    }
    convertToPositive(number){
        if (number < 0)
            return number * -1
        return number

    }
    calcDis( val1, val2, control){
        const soma = this.convertToPositive(val1[0] - val2[0])^2 + (val1[1] - val2[1])^2;
        let distancia = 0;
        
        if (parseInt(soma) == 0){
            distancia = 0;
        }else{
            distancia = Math.sqrt(parseInt(soma));
            if(Number.isNaN(distancia))
                distancia = control
        }
        return distancia;

    }

    getAVCPositions(face){
        face.avc.sobrancelhaDir = [face.getXbyId(105), face.getYbyId(105)];
        face.avc.sobrancelhaEsq = [face.getXbyId(334), face.getYbyId(334)];
        face.avc.testaDir = [face.getXbyId(103), face.getYbyId(103)];
        face.avc.testaEsq = [face.getXbyId(332), face.getYbyId(332)];
        if(
            this.convertToPositive(this.calcDis( face.avc.sobrancelhaDir, face.avc.testaDir, 1000 )
            -
            this.calcDis( face.avc.sobrancelhaEsq, face.avc.testaEsq, 1000 ))
        >1.5){
        console.log(
            "foi"
            );
        }
        
    }

    getRadialPositions(face){
        
        face.radial.p1 = [face.getXbyId(33), face.getYbyId(33)];
        face.radial.p2 = [face.getXbyId(263), face.getYbyId(263)];
        face.radial.p3 = [face.getXbyId(154), face.getYbyId(154)];
        face.radial.p4 = [face.getXbyId(398), face.getYbyId(398)];
        face.radial.p5 = [face.getXbyId(127), face.getYbyId(127)];
        face.radial.p6 = [face.getXbyId(356), face.getYbyId(356)];
        face.radial.p7 = [face.getXbyId(49), face.getYbyId(49)];
        face.radial.p8 = [face.getXbyId(1), face.getYbyId(1)];
        face.radial.p9 = [face.getXbyId(279), face.getYbyId(279)];
        face.radial.p10 = [face.getXbyId(58), face.getYbyId(58)];
        face.radial.p11 = [face.getXbyId(61), face.getYbyId(61)];
        face.radial.p12 = [face.getXbyId(291), face.getYbyId(291)];
        face.radial.p13 = [face.getXbyId(288), face.getYbyId(288)];
        face.radial.p14 = [face.getXbyId(176), face.getYbyId(176)];
        face.radial.p15 = [face.getXbyId(400), face.getYbyId(400)];
        face.radial.p16 = [face.getXbyId(9), face.getYbyId(9)];
        face.radial.p17 = [face.getXbyId(152), face.getYbyId(152)];
        
        face.radial.calcDis();

    }

    getNottinghamPositions(face){
        var SupraorbitalDir = { 52: [0,0] , 65 : [0,0] };
        var SupraorbitalEsq = { 282: [0,0]  , 295: [0,0] };

        SupraorbitalDir[52][0] =  face.getXbyId(52);
        SupraorbitalDir[52][1] =  face.getYbyId(52);
        SupraorbitalDir[65][0] =  face.getXbyId(65);
        SupraorbitalDir[65][1] =  face.getYbyId(65);

        SupraorbitalEsq[282][0] =  face.getXbyId(282);
        SupraorbitalEsq[282][1] =  face.getYbyId(282);
        SupraorbitalEsq[295][0] =  face.getXbyId(295);
        SupraorbitalEsq[295][1] =  face.getYbyId(295);

        var {x, y} = face.nottingham.calcSupraorbital(
            SupraorbitalDir[52][0],
            SupraorbitalDir[52][1],
            SupraorbitalDir[65][0],
            SupraorbitalDir[65][1]
        );
        face.nottingham.supraorbitalDir[0] = x;
        face.nottingham.supraorbitalDir[1] = y;

        var {x, y} = face.nottingham.calcSupraorbital(
            SupraorbitalEsq[282][0],
            SupraorbitalEsq[282][1],
            SupraorbitalEsq[295][0],
            SupraorbitalEsq[295][1]
        );

        face.nottingham.supraorbitalEsq[0] = x;
        face.nottingham.supraorbitalEsq[1] = y;

        face.nottingham.infraorbitalDir[0] =  face.getXbyId(119);
        face.nottingham.infraorbitalDir[1] =  face.getYbyId(119);

        face.nottingham.infraorbitalEsq[0] =  face.getXbyId(348);
        face.nottingham.infraorbitalEsq[1] =  face.getYbyId(348);

        face.nottingham.cantoLateralDir[0] =  face.getXbyId(33);
        face.nottingham.cantoLateralDir[1] =  face.getYbyId(33);

        face.nottingham.cantoLateralEsq[0] =  face.getXbyId(263);
        face.nottingham.cantoLateralEsq[1] =  face.getYbyId(263);

        face.nottingham.comissuraLabialDir[0] =  face.getXbyId(61);
        face.nottingham.comissuraLabialDir[1] =  face.getYbyId(61);

        face.nottingham.comissuraLabialEsq[0] =  face.getXbyId(291);
        face.nottingham.comissuraLabialEsq[1] =  face.getYbyId(291);
    }

    
}

export default AppController;


/*
            //drawConnectors(this.canvasCtx, landmarks, FACEMESH_TESSELATION, {color: '#00f', lineWidth: 1});
            //drawConnectors(this.canvasCtx, landmarks, FACEMESH_RIGHT_EYE, {color: '#FF3030'});
            //drawConnectors(this.canvasCtx, landmarks, FACEMESH_RIGHT_EYEBROW, {color: '#fff'});
            //drawConnectors(this.canvasCtx, landmarks, FACEMESH_LEFT_EYE, {color: '#30FF30'});
            //drawConnectors(this.canvasCtx, landmarks, FACEMESH_LEFT_EYEBROW, {color: '#fff'});
            //drawConnectors(this.canvasCtx, landmarks, FACEMESH_FACE_OVAL, {color: '#E0E0E0'});
            //drawConnectors(this.canvasCtx, landmarks, FACEMESH_LIPS, {color: '#E0E0E0'});
            */