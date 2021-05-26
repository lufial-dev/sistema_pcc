import Capture from '../models/capture.js';
class CaptureController{
    constructor({face, textInstruction, texts, faces, buttonStart, divResults}){
        this.captures = [];
        this.face = face;
        this.textInstruction = textInstruction;
        this.texts = texts;
        this.faces = faces;
        this.buttonStart = buttonStart;
        this.isCaptured = false;
        this.divResults = divResults;
        this.contSleep = 0;
        this.images = [];
        this.createFace = true;
        this.face_id;
        this.loadCapture = false;
    }

    startCapture(canvas, camera) {
        if(this.faces.length > 1){
            if(!this.loadCapture){
                if(this.textInstruction.innerHTML==this.texts[0] && this.isStop(0)){
                    this.textInstruction.innerHTML = this.texts[1];
                    var image =canvas.toDataURL("image/png");
                    document.getElementById("status-"+0).src = image;
                    this.captures.push(new Capture({image:image , face: this.face, mimica: "Repouso"}));   
                    document.getElementById("menu-capture").style.display = "none";
                    document.getElementById("menu-final").style.display = "flex";
                    document.getElementById("button-results").onclick = ()=>this.toResults();   
                              
                }
                else if(this.textInstruction.innerHTML == this.texts[1]  && this.isEyebrown()){
                    if(this.isStop(1)){
                        this.textInstruction.innerHTML = this.texts[2];
                        var image =canvas.toDataURL("image/png");
                        document.getElementById("status-"+1).src = image;
                        this.captures.push(new Capture({image:image , face: this.face, mimica: "Sobrancelhas Erguidas"}));
                    }
                }
                else if(this.textInstruction.innerHTML == this.texts[2]  && this.isSmile(0)){
                    if(this.isStop(2)){
                        this.textInstruction.innerHTML = this.texts[3];
                        var image =canvas.toDataURL("image/png");
                        document.getElementById("status-"+2).src = image;
                        this.captures.push(new Capture({image:image , face: this.face, mimica: "Sorrindo"}));
                    }
                }
                    
                else if(this.textInstruction.innerHTML == this.texts[3]  && this.isPressEyes()){
                    if(this.isStop(3)){
                        this.textInstruction.innerHTML = "Captura Concluída";
                        var image =canvas.toDataURL("image/png");
                        document.getElementById("status-"+3).src = image;
                        this.captures.push(new Capture({image:image , face: this.face, mimica: "Olhos Fechados"}));
                        this.isCaptured = false;
                       
                       
                    }
                }
            }else{
                document.getElementById("load-dados").style.display = "block";
            }
        }
        

    }

    toResults(){
        this.loadCapture = true;
        //console.log(JSON.stringify(this.captures));
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost/sistema_pcc/service/save.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("capture="+JSON.stringify(this.captures));

        xhr.onreadystatechange = () => {
            if(xhr.readyState == 4) { 
                if(xhr.status == 200) {              
                    this.loadCapture = false;
                    document.getElementById("load-dados").style.display = "none";
                    document.getElementById("m-modal-load-data").style.display="flex";
                    document.getElementById("input-data").value =  JSON.stringify(this.captures);                  
                }
            }
        
        };
    }

    // toCreateFace(){
    //     let xhr = new XMLHttpRequest();
    //     xhr.open('POST', 'http://localhost/sistema_pcc/service/save_face.php', true);
    //     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //     xhr.send();

    //     xhr.onreadystatechange = () => {

    //         if(xhr.readyState == 4) {
    //             if(xhr.status == 200) {
    //                 this.face_id=xhr.responseText;
    //             }
    //         }
        
    //     };
    // }

    isSmile(taxa){
            var disSmileCapture = this.convertToPositive(this.captures[0].face.nottingham.comissuraLabialDir[0] - this.captures[0].face.nottingham.comissuraLabialEsq[0]);
            var disSmileFace = this.convertToPositive(this.face.nottingham.comissuraLabialDir[0] - this.face.nottingham.comissuraLabialEsq[0]);
            var percent = disSmileCapture*8/100;
            if (this.convertToPositive(disSmileCapture - disSmileFace) > percent - taxa)
                return true
            return false
    }

    isPressEyes(){
        const disDirCapture = this.captures[0].face.nottingham.comissuraLabialDir[1] - this.captures[0].face.nottingham.supraorbitalDir[1];
        const disEsqCapture = this.captures[0].face.nottingham.comissuraLabialEsq[1] - this.captures[0].face.nottingham.supraorbitalEsq[1] ;
        const disDirFace = this.face.nottingham.comissuraLabialDir[1] - this.face.nottingham.supraorbitalDir[1];
        const disEsqFace = this.face.nottingham.comissuraLabialEsq[1] - this.face.nottingham.supraorbitalEsq[1] ;

        const percentDir = disDirCapture*6/100;
        const percentEsq = disEsqCapture*6/100;
        console.log(percentDir);
        if(
            (this.convertToPositive(disEsqFace - disEsqCapture) > percentDir || this.convertToPositive(disDirFace - disDirCapture) > percentEsq) 
            && !this.isSmile(5)
        )
            return true
        return false
    }

    

    isEyebrown(){
        const disDirCapture = this.captures[0].face.nottingham.infraorbitalDir[1] - this.captures[0].face.nottingham.supraorbitalDir[1];
        const disEsqCapture = this.captures[0].face.nottingham.infraorbitalEsq[1] - this.captures[0].face.nottingham.supraorbitalEsq[1] ;
        const disDirFace = this.face.nottingham.infraorbitalDir[1] - this.face.nottingham.supraorbitalDir[1];
        const disEsqFace = this.face.nottingham.infraorbitalEsq[1] - this.face.nottingham.supraorbitalEsq[1] ;
        
        const percentDir = disDirCapture * 8 / 100;
        const percentEsq = disEsqCapture * 8 /100;

        if(
            (this.convertToPositive(disDirFace - disDirCapture)> percentDir || this.convertToPositive(disEsqFace - disEsqCapture)>percentEsq)
        )
            return true
        return false

    }

    convertToPositive(number){
        if (number < 0)
            return number * -1
        return number

    }

    isStop(image){
        var posXDir = this.face.getXbyId(234);
        var posXEsq = this.face.getXbyId(454);
        if(this.contSleep > 40){
            this.contSleep = 0
            return true
        }
        else if(posXDir > 120 && posXDir < 220 && posXEsq > 480 && posXEsq < 560){ 
            if(this.contSleep < 40 && this.contSleep > 30)
                document.getElementById("status-"+image).src = "views/assets/images/user-load-100.png";
            else if(this.contSleep < 30 && this.contSleep > 20)
                document.getElementById("status-"+image).src = "views/assets/images/user-load-75.png";
            else if(this.contSleep < 20 && this.contSleep > 10)
                document.getElementById("status-"+image).src = "views/assets/images/user-load-50.png";
            else if(this.contSleep < 10)
                document.getElementById("status-"+image).src = "views/assets/images/user-load-25.png";
            
            
           
            
            this.contSleep += 1;
            return false
            
        }else{
            this.contSleep = 0
        }       

        return false
    }
 
    soma(distancias){
        let soma = 0;
        for(const d of distancias)
            soma+=d;
        return soma;
    }



    calcDistancia( val1, val2, control){
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

    captureRest(){

    }
}

export default CaptureController;