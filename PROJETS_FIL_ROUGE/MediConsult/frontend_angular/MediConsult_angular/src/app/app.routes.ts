import { Routes } from '@angular/router';
import { HomepageComponent } from './homepage/homepage.component';
import { InscriptionComponent } from './inscription/inscription.component';
import { ConnexionComponent } from './connexion/connexion.component';
import { MedecinsComponent } from './medecins/medecins.component';

export const ROUTES: Routes = [
  { path:"", component: HomepageComponent},
  { path:"inscription", component: InscriptionComponent},
  { path:"connexion", component: ConnexionComponent },
  { path:"medecins", component: MedecinsComponent}
]
