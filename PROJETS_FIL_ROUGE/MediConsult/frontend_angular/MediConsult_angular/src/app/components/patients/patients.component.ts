import { Component, OnInit } from '@angular/core';
import { PatientModele } from '../../modeles/patient.modele';
import { PatientService } from '../../services/patient.service';

@Component({
  selector: 'app-patients',
  templateUrl: './patients.component.html',
  styleUrls: ['./patients.component.css']
})
export class PatientsComponent implements OnInit {

  nbPatients:number;
  listePatients: PatientModele[];

  constructor(private patientService: PatientService) { }

  ngOnInit(): void {
    this.patientService.getAllPatients().subscribe((response) => {
      this.listePatients = response.body;
      this.nbPatients = this.listePatients.length;
    }, (error) => {
      console.log(error);
    });
  }

}
