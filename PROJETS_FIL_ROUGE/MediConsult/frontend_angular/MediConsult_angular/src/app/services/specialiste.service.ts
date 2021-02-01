import { HttpClient } from '@angular/common/http';
import { EventEmitter, Injectable } from '@angular/core';
import { SpecialisteModele } from '../modeles/specialiste.modele';

@Injectable ({
  providedIn: 'root'
})
export class SpecialisteService {

  constructor(private http: HttpClient){}

  getAllSpecialistes(){
    return this.http.get<SpecialisteModele[]>("http://localhost:8000/specialistes", {observe: 'response'});
  }

  getSpecialisteById(id:number){
    return this.http.get<SpecialisteModele[]>("http://localhost:8000/specialistes/"+id, {observe: 'response'});
  }

}
