import { Component, OnInit, Input, EventEmitter } from '@angular/core';
import { SpecialisteService } from '../../../services/specialiste.service';
import { SpecialisteModele } from '../../../modeles/specialiste.modele';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-specialiste',
  templateUrl: './specialiste.component.html',
  styleUrls: ['./specialiste.component.css']
})
export class SpecialisteComponent implements OnInit {

  @Input() leSpecialiste : { id: number, nom: string, prenom: string, adresse: string, specialite: string};

  constructor(private specialisteService: SpecialisteService, private route:ActivatedRoute) { }

  ngOnInit(){
  }

}
