import { Component, EventEmitter, Output} from '@angular/core';
import { VoitureService } from '../common/voiture.service';

@Component({
  selector: 'app-liste-voitures',
  templateUrl: './liste-voitures.component.html'
})
export class ListeVoituresComponent {

  @Output() selectVoiture = new EventEmitter<{marque : string, estDemarree : boolean}>();

  voitures: {marque : string, estDemarree : boolean}[];

  constructor(private VoitureService : VoitureService) {
    this.voitures = this.VoitureService.getAllVoitures();
  }

}
