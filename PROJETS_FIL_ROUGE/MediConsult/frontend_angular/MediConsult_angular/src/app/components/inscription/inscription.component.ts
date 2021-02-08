import { Component, OnInit } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { NgForm } from '@angular/forms';
import { PatientService } from 'src/app/services/patient.service';
import { SpecialisteService } from 'src/app/services/specialiste.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-inscription',
  templateUrl: './inscription.component.html',
  styleUrls: ['./inscription.component.css']
})
export class InscriptionComponent implements OnInit {

  getProfil: string;


  form: {};
  nom: string;
  prenom: string;
  age: number;
  adresse: string;
  specialite: string;
  email: string;
  password: string;

  constructor(private patientService : PatientService, private specialisteService : SpecialisteService, private router : Router) { }

  ngOnInit(): void {
  }

  getProfilUser(event : Event){
    this.getProfil = (<HTMLInputElement>event.target).value
  }

inscription(){
  if(this.getProfil == "patient"){
    this.form={
      nom:this.nom,
      prenom:this.prenom,
      age:this.age,
      email: this.email,
      password: this.password
    }
    this.patientService.addPatient(this.form).subscribe(
      (response)=>{
        console.log(response);
    })
  }
  if(this.getProfil == "specialiste"){
    this.form={
      nom:this.nom,
      prenom:this.prenom,
      adresse:this.adresse,
      specialite:this.specialite,
      email: this.email,
      password: this.password
    }
    this.specialisteService.addSpecialiste(this.form).subscribe((response)=>{
      console.log(response);
    })
  }
}


}
