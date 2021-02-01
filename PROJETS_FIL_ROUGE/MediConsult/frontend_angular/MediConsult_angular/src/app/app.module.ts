import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';

import { RouterModule } from '@angular/router';
import { ROUTES } from './app.routes';

import { AppComponent } from './components/app.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { HomepageComponent } from './components/homepage/homepage.component';
import { InscriptionComponent } from './components/inscription/inscription.component';
import { ConnexionComponent } from './components/connexion/connexion.component';
import { SpecialistesComponent } from './components/specialistes/specialistes.component';
import { SearchbarComponent } from './components/searchbar/searchbar.component';
import { SpecialisteComponent } from './components/specialistes/specialiste/specialiste.component';
import { DetailSpecialisteComponent } from './components/detail-specialiste/detail-specialiste.component';

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
  ],
  imports: [
    BrowserModule,
    FormsModule,
    RouterModule.forRoot(ROUTES)
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
