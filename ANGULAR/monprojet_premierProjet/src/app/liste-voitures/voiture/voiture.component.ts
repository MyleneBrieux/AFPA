import { Component, EventEmitter, Input, Output } from '@angular/core';
import { VoitureService } from 'src/app/common/voiture.service';

@Component({
  selector: 'app-voiture',
  templateUrl: './voiture.component.html',
  styleUrls: ['./voiture.component.css']
})
export class VoitureComponent {

  @Output() selectVoiture = new EventEmitter<{marque: string, estDemarree: boolean}>()

  @Input() laVoiture : {marque:string,estDemarree:boolean;}


  constructor(private VoitureService: VoitureService) { }

  ngOnInit(): void {
  }


  demarrerArreter(){
    if(this.laVoiture.estDemarree){
      this.laVoiture.estDemarree = false;
    } else if(!this.laVoiture.estDemarree){
      this.laVoiture.estDemarree = true;
    }
  }

  onSelectedVoiture(marque: string){
    this.VoitureService.emitVoitureSelected(marque);
  }

}
