import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { UnitsPage } from './units.page';

const routes: Routes = [
  {
    path: '',
    component: UnitsPage
  },
  {
    path: 'details-units/:id',
    loadChildren: () => import('./details-units/details-units.module').then( m => m.DetailsUnitsPageModule)
  }

];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class UnitsPageRoutingModule {}
