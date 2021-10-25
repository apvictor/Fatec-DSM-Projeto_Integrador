import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { DetailsUnitsPage } from './details-units.page';

const routes: Routes = [
  {
    path: '',
    component: DetailsUnitsPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class DetailsUnitsPageRoutingModule {}
