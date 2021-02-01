import { Component, OnInit } from '@angular/core';
import { SpecialisteService } from '../../services/specialiste.service';
import { SpecialisteModele } from '../../modeles/specialiste.modele';

@Component({
  selector: 'app-specialistes',
  templateUrl: './specialistes.component.html',
  styleUrls: ['./specialistes.component.css']
})
export class SpecialistesComponent implements OnInit {

  nbSpecialistes:number;
  listeSpecialistes: SpecialisteModele[];

  constructor(private specialisteService: SpecialisteService) { }

  ngOnInit(): void {
    this.specialisteService.getAllSpecialistes().subscribe((response) => {
      this.listeSpecialistes = response.body;
      this.nbSpecialistes = this.listeSpecialistes.length;
    }, (error) => {
      console.log(error);
    });
  }

}
