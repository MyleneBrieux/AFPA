import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { VoitureService } from '../../common/voiture.service';

@Component({
  selector: 'app-ajouter-voiture',
  templateUrl: './ajouter-voiture.component.html',
  styleUrls: ['./ajouter-voiture.component.css']
})
export class AjouterVoitureComponent implements OnInit {

  @Output() addVoitureEventEmitter = new EventEmitter<{marque: string, statut: string}>();

  inputValue : string = '';

  constructor(private VoitureService: VoitureService) { }

  ngOnInit(): void {
  }

  // onAddVoiture(){
  //   this.addVoitureEventEmitter.emit({marque: this.inputValue, statut: "Arrêtée"});
  // }

  onAddVoiture2(value:string){
    this.VoitureService.addNewVoiture({marque: value, estDemarree: false});
    // this.addVoitureEventEmitter.emit({marque: value, statut: "Arrêtée"});
  }

  onKeyUp(event:Event){
    this.inputValue = (<HTMLInputElement>event.target).value;
  }

}
