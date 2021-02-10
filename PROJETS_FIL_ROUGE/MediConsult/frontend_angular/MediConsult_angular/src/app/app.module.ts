import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { RouterModule } from '@angular/router';
import { ROUTES } from './app.routes';
import { NgxSpinnerModule } from 'ngx-spinner';
import { NgxPaginationModule } from 'ngx-pagination';

import { AppComponent } from './components/app.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { HomepageComponent } from './components/homepage/homepage.component';
import { InscriptionComponent } from './components/inscription/inscription.component';
import { ConnexionComponent } from './components/connexion/connexion.component';
import { SpecialistesComponent } from './components/specialistes/specialistes.component';
import { SearchbarComponent } from './components/searchbar/searchbar.component';
import { SpecialisteComponent } from './components/specialistes/specialiste/specialiste.component';
import { DetailSpecialisteComponent } from './components/detail-specialiste/detail-specialiste.component';
import { ProfilComponent } from './components/profil/profil.component';
import { ProfilSpecialisteComponent } from './components/profil/profil-specialiste/profil-specialiste.component';
import { ProfilPatientComponent } from './components/profil/profil-patient/profil-patient.component';
import { PatientsComponent } from './components/patients/patients.component';
import { PatientComponent } from './components/patients/patient/patient.component';
import { DetailPatientComponent } from './components/detail-patient/detail-patient.component';
import { FormRendezVousComponent } from './components/form-rendez-vous/form-rendez-vous.component';

import { SpecialisteService } from './services/specialiste.service';
import { PatientService } from './services/patient.service';
import { CommonService } from './services/common.service';


@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    HomepageComponent,
    InscriptionComponent,
    ConnexionComponent,
    SpecialistesComponent,
    SearchbarComponent,
    SpecialisteComponent,
    DetailSpecialisteComponent,
    ProfilComponent,
    ProfilSpecialisteComponent,
    ProfilPatientComponent,
    PatientsComponent,
    PatientComponent,
    DetailPatientComponent,
    FormRendezVousComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    RouterModule.forRoot(ROUTES),
    NgxSpinnerModule,
    NgxPaginationModule
  ],
  providers: [
    SpecialisteService,
    PatientService,
    CommonService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
