import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Geolocation } from '@ionic-native/geolocation/ngx';
import { AlertController, LoadingController, ToastController } from '@ionic/angular';
import { Observable } from 'rxjs';
import { map, tap } from 'rxjs/operators';
import { AuthService } from '../services/auth.service';
import { Units } from '../units/units.model';

@Component({
  selector: 'app-units',
  templateUrl: './units.page.html',
  styleUrls: ['./units.page.scss'],
})
export class UnitsPage implements OnInit {

  units$: Observable<Units[]>

  latUser;
  longUser;

  unit: any = [];
  km;
  result = [];

  constructor(
    private geolacation: Geolocation,
    private authService: AuthService,
    private loadingCtrl: LoadingController,
    private alertCtrl: AlertController,
    private toastCtrl: ToastController,
    private router: Router,
    public http: HttpClient
  ) { }

  ngOnInit() {

    // const loading = await this.loadingCtrl.create({ message: 'Carregando...' });
    // loading.present();
    // loading.dismiss();
    this.localizaUser();
    this.localizaUnits();

  }

  localizaUser() {
    this.geolacation.getCurrentPosition({
      timeout: 10000,
      enableHighAccuracy: true
    }).then((res) => {
      this.latUser = res.coords.latitude;
      this.longUser = res.coords.latitude;
      console.log();
    }).catch((e) => {
      console.log(e);
    })
  }


  async localizaUnits() {
    this.unit = this.authService.units().pipe(
      map((units) => {
        // for (let i = 0; i < units.length; i++) {
        //   this.unit.push(units[i]);

        //    this.km = this.getDistanceFromLatLonInKm(units[i].latitude, units[i].longitude, this.latUser, this.longUser);
        //   // console.log(units[i]);

        // }

        // this.unit = units;


        console.log(this.unit);

      })
    )


  }



  // Calcular lat e long e retornar em Km
  getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
    var R = 6371; // Radius of the earth in km
    var dLat = this.deg2rad(lat2 - lat1);  // deg2rad below
    var dLon = this.deg2rad(lon2 - lon1);
    var a =
      Math.sin(dLat / 2) * Math.sin(dLat / 2) +
      Math.cos(this.deg2rad(lat1)) * Math.cos(this.deg2rad(lat2)) *
      Math.sin(dLon / 2) * Math.sin(dLon / 2)
      ;
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c; // Distance in km
    return d.toFixed(2);
  }

  deg2rad(deg) {
    return deg * (Math.PI / 180)
  }


}
