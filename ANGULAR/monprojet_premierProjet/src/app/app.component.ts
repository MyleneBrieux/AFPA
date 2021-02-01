import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { VoitureService } from './common/voiture.service';
import { PraticienService } from './praticien.service';
import { Praticien } from './praticien.modele';


@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {

  color = 'pink';

  laVoitureSelectionnee: {marque:string, estDemarree:boolean};

  listePraticiens: Praticien[];

  newPraticien = {
    id: 1,
    nom: "TEST2",
    prenom: "test2",
    adresse: "adresse test2",
    telephone: "telephone test2",
    presentation: "presentation test2",
    horaires: "horaires test2",
    moyensPaiement: "moyensPaiement test2",
    rendezVous: 4,
    specialite: 19,
    email:"test2@test.com",
    // roles:[],
    password:"testpassword2"
  };

  constructor(private VoitureService: VoitureService, private praticienService: PraticienService) {
      this.praticienService.addPraticien(this.newPraticien).subscribe(praticien => this.listePraticiens.push(praticien));
  }

  ngOnInit(){ // quand on veut exploiter directement les données, faire le subscribe au niveau du component //
    this.praticienService.searchAllPraticiens().subscribe((response) => {
      console.log(response);
      this.listePraticiens = response.body;
    }, (error) => {
      console.log(error);
    });
  }

  onReceivedVoiture(voitureRecue: {marque:string, estDemarree: boolean}){
    this.laVoitureSelectionnee= voitureRecue;
  }

  onAddVoiture2(value:string){
    this.VoitureService.addNewVoiture({marque: value, estDemarree: false});
  }

  inscription(form: NgForm){
    console.log(form);
  }
}
