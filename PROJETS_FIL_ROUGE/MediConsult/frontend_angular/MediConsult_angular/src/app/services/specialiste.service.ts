import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { SpecialisteModele } from '../modeles/specialiste.modele';

@Injectable ({
  providedIn: 'root'
})
export class SpecialisteService {

  constructor(private http: HttpClient){}

  searchAllSpecialistes(){
    return this.http.get<SpecialisteModele[]>("http://localhost:8000/specialistes", {observe: 'response'})
  }

}
