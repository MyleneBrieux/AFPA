import { Component, OnInit } from '@angular/core';
import { VoitureService } from '../common/voiture.service';

@Component({
  selector: 'app-detail-voiture',
  templateUrl: './detail-voiture.component.html',
  styleUrls: ['./detail-voiture.component.css']
})
export class DetailVoitureComponent implements OnInit {

  voiture: {marque: string, estDemarree: boolean};


  constructor(private VoitureService: VoitureService) {
    this.VoitureService.selectVoiture.subscribe(marque => {
      this.voiture = this.VoitureService.getDetailVoiture(marque);
    });
  }

  ngOnInit(): void {
  }

}
