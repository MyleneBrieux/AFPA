import { Component, OnInit } from '@angular/core';
import { SpecialisteService } from '../../../services/specialiste.service';
import { SpecialisteModele } from '../../../modeles/specialiste.modele';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-specialiste',
  templateUrl: './specialiste.component.html',
  styleUrls: ['./specialiste.component.css']
})
export class SpecialisteComponent implements OnInit {

  listeSpecialistes: SpecialisteModele[];

  constructor(private specialisteService: SpecialisteService, private route:ActivatedRoute) { }

  ngOnInit(){
    this.specialisteService.getAllSpecialistes().subscribe((response) => {
      this.listeSpecialistes = response.body;
    }, (error) => {
      console.log(error);
    });
  }

}
