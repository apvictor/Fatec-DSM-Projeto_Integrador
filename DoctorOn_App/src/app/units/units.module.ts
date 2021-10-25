import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { UnitsPageRoutingModule } from './units-routing.module';

import { UnitsPage } from './units.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    UnitsPageRoutingModule
  ],
  declarations: [UnitsPage]
})
export class UnitsPageModule {}
