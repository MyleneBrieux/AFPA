import { Component, OnInit } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { NgForm } from '@angular/forms';
import { PatientService } from 'src/app/services/patient.service';
import { SpecialisteService } from 'src/app/services/specialiste.service';
import { Router } from '@angular/router';
import { NgxSpinnerService } from "ngx-spinner";
import { CommonService } from 'src/app/services/common.service';

@Component({
  selector: 'app-connexion',
  templateUrl: './connexion.component.html',
  styleUrls: ['./connexion.component.css']
})
export class ConnexionComponent implements OnInit {

  getProfil: string;

  email: string;
  password: string;

  ok: boolean = false ;

  pattern: string | RegExp;


  constructor(private commonService: CommonService, private router : Router) { }

  ngOnInit(): void {
  }


  getProfilUser(event : Event){
    this.getProfil = (<HTMLInputElement>event.target).value;
    console.log(this.getProfil);
  }

  connexion(){
    this.commonService.getUserByEmail(this.email, this.password, this.getProfil).subscribe((response)=>{
      if(response.status == 200){
        if (this.getProfil == "specialiste") {
          this.router.navigate(['/patients']);
          console.log(this.getProfil);
        }
        else{
          this.router.navigate(['/specialistes']);
          console.log(this.getProfil);
        }

      }
    })
  }

}
