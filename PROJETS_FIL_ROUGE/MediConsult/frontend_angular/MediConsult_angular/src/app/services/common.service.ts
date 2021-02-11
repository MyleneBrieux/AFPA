import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { PatientModele } from '../modeles/patient.modele';
import { SpecialisteModele } from '../modeles/specialiste.modele';

@Injectable ({
  providedIn: 'root'
})
export class CommonService {

  specialistes
  patients


  constructor(private http: HttpClient){}


  getUserByEmail(email:string, password:string, getProfil:string){
    if(getProfil == "specialiste"){
      this.specialistes=this.http.get<SpecialisteModele[]>("http://localhost:8000/specialistes?email=" + email +"&password=" + password , {observe : 'response'})
      return this.specialistes
    }
    if(getProfil == "patient"){
      this.patients=this.http.get<PatientModele[]>("http://localhost:8000/patients?email=" + email +"&password=" + password , {observe : 'response'})
      return this.patients
    }
  }

}
