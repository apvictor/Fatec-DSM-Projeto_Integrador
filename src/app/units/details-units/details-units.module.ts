import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { DetailsUnitsPageRoutingModule } from './details-units-routing.module';

import { DetailsUnitsPage } from './details-units.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    DetailsUnitsPageRoutingModule
  ],
  declarations: [DetailsUnitsPage]
})
export class DetailsUnitsPageModule {}
