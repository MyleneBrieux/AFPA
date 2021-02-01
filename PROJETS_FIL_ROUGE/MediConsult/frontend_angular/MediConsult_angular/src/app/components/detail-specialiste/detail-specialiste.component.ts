import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { SpecialisteService } from '../../services/specialiste.service';
import { SpecialisteModele } from '../../modeles/specialiste.modele';

@Component({
  selector: 'app-detail-specialiste',
  templateUrl: './detail-specialiste.component.html',
  styleUrls: ['./detail-specialiste.component.css']
})
export class DetailSpecialisteComponent implements OnInit {

  specialiste:any;

  constructor(private activatedRoute: ActivatedRoute, private specialisteService: SpecialisteService) {
  }

  ngOnInit() : void {
    const idSpecialiste=this.activatedRoute.snapshot.params['id'];
    this.specialisteService.getSpecialisteById(idSpecialiste).subscribe((response) => {
      this.specialiste = response.body;
    }, (error) => {
      console.log(error);
    });
  }

}
