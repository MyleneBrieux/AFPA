import { HttpClient } from '@angular/common/http';
import { EventEmitter, Injectable } from '@angular/core';
import { NgForm } from '@angular/forms';
import { PatientModele } from '../modeles/patient.modele';

@Injectable ({
  providedIn: 'root'
})
export class PatientService {

  constructor(private http: HttpClient){}

  getAllPatients(){
    return this.http.get<PatientModele[]>("http://localhost:8000/patients", {observe: 'response'});
  }

  getPatientById(id:number){
    return this.http.get<PatientModele[]>("http://localhost:8000/patients/"+id, {observe: 'response'});
  }

  addPatient(form: {}){
    return this.http.post<PatientModele[]>("http://localhost:8000/patients", form, {observe: 'response'})
  }

}
