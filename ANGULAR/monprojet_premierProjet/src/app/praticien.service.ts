import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Praticien } from './praticien.modele';
import { Observable, throwError } from 'rxjs';
import { catchError, retry } from 'rxjs/operators';

@Injectable ({
  providedIn: 'root'
})
export class PraticienService {

  listePraticiens: Praticien[];

  constructor(private http: HttpClient){}

  searchAllPraticiens(){
    return this.http.get<Praticien[]>("http://localhost:8000/praticiens", {observe: 'response'})
  }

  addPraticien(praticien: Praticien){
    return this.http.post<Praticien>("http://localhost:8000/praticiens", praticien)
    .pipe();

  }

}
