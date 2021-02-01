import { EventEmitter } from "@angular/core";

export class VoitureService {

  voitures : {marque : string, estDemarree : boolean}[] = [
    {
      marque : "FIAT",
      estDemarree : true
    },
    {
      marque : "OPEL",
      estDemarree : false
    },
    {
      marque : "RENAULT",
      estDemarree : true
    }
  ];

  selectVoiture = new EventEmitter<string>();

  getAllVoitures(){
    return this.voitures;
  }

  addNewVoiture(voiture:{marque:string, estDemarree:boolean}){
    this.voitures.push(voiture);
  }

  emitVoitureSelected(marque: string){
    this.selectVoiture.emit(marque);
  }

  getDetailVoiture(marque){
    for (const voiture of this.voitures) {
      if(marque === voiture.marque){
        return voiture;
      }
    }
  }

}
