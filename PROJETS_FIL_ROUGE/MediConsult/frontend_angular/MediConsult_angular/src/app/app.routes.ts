import { Routes } from '@angular/router';
import { HomepageComponent } from './components/homepage/homepage.component';
import { InscriptionComponent } from './components/inscription/inscription.component';
import { ConnexionComponent } from './components/connexion/connexion.component';
import { SpecialistesComponent } from './components/specialistes/specialistes.component';

export const ROUTES: Routes = [
  { path:"", component: HomepageComponent},
  { path:"inscription", component: InscriptionComponent},
  { path:"connexion", component: ConnexionComponent },
  { path:"specialistes", component: SpecialistesComponent}
]
