import { Component, OnInit } from '@angular/core';
import { SpecialisteService } from '../../services/specialiste.service';
import { SpecialisteModele } from '../../modeles/specialiste.modele';
import { NgxSpinnerService } from "ngx-spinner";
import {NgxPaginationModule} from 'ngx-pagination';

@Component({
  selector: 'app-specialistes',
  templateUrl: './specialistes.component.html',
  styleUrls: ['./specialistes.component.css']
})
export class SpecialistesComponent implements OnInit {

  page = 1;
  count = 0;
  tableSize = 4;

  nbSpecialistes:number;
  listeSpecialistes: SpecialisteModele[];

  constructor(private specialisteService: SpecialisteService, private SpinnerService: NgxSpinnerService) { }

  ngOnInit(): void {
    this.getNumberOfSpecialistes();
    this.showAllSpecialistes();
  }

  getNumberOfSpecialistes() {
    this.SpinnerService.show();
    this.specialisteService.getAllSpecialistes().subscribe((response) => {
      this.listeSpecialistes = response.body;
      this.nbSpecialistes = this.listeSpecialistes.length;
      this.SpinnerService.hide();
    }, (error) => {
      console.log(error);
    });
  }

  showAllSpecialistes(){
    this.specialisteService.getAllSpecialistes().subscribe((response) => {
      this.listeSpecialistes = response.body;
    }, (error) => {
      console.log(error);
    });
  }

  onDataChange(event){
    this.page = event;
    this.showAllSpecialistes();
  }

}
