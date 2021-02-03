import { HttpClient } from '@angular/common/http';
import { EventEmitter, Injectable } from '@angular/core';
import { SpecialisteModele } from '../modeles/specialiste.modele';

@Injectable ({
  providedIn: 'root'
})
export class SpecialisteService {

  selectSpecialiste = new EventEmitter<any>();

  constructor(private http: HttpClient){}

  getAllSpecialistes(){
    return this.http.get<SpecialisteModele[]>("http://localhost:8000/specialistes", {observe: 'response'});
  }

  getSpecialisteById(id:number){
    return this.http.get<SpecialisteModele[]>("http://localhost:8000/specialistes/id/"+id, {observe: 'response'});
  }

  emitSelectSpecialisteById(id:number){
    this.selectSpecialiste.emit(id);
  }

  getSpecialisteBySpecialite(specialite: string){
    return this.http.get<SpecialisteModele[]>("http://localhost:8000/specialistes/"+specialite, {observe: 'response'});
  }

  getSpecialisteByNom(nom: string){
    return this.http.get<SpecialisteModele[]>("http://localhost:8000/specialistes/"+nom, {observe: 'response'});
  }

}
