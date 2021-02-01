import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { ListeVoituresComponent } from './liste-voitures/liste-voitures.component';
import { DetailVoitureComponent } from './detail-voiture/detail-voiture.component';
import { VoitureComponent } from './liste-voitures/voiture/voiture.component';
import { AjouterVoitureComponent } from './liste-voitures/ajouter-voiture/ajouter-voiture.component';
import { VoitureService } from './common/voiture.service';
import { HighlightDirective } from './directives/highlight.directive';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { PraticienService } from './praticien.service';

@NgModule({
  declarations: [
    AppComponent,
    ListeVoituresComponent,
    DetailVoitureComponent,
    VoitureComponent,
    AjouterVoitureComponent,
    HighlightDirective
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule
  ],
  providers: [
    VoitureService,
    PraticienService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
