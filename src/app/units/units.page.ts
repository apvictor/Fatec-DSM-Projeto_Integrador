import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AlertController, LoadingController, ToastController } from '@ionic/angular';
import { AuthService } from '../services/auth.service';
import { Geolocation } from '@ionic-native/geolocation/ngx';

@Component({
  selector: 'app-units',
  templateUrl: './units.page.html',
  styleUrls: ['./units.page.scss'],
})
export class UnitsPage implements OnInit {

  latUser;
  longUser;
  km;

  unidade: any[];
  aux_unidade: any = [];

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
    this.localizaUser();
  }

  async localizaUser() {
    const loading = await this.loadingCtrl.create({ message: 'Buscando Unidades...' });
    loading.present();
    this.geolacation.getCurrentPosition({
      timeout: 10000,
      enableHighAccuracy: true
    }).then((res) => {
      console.log(res.coords.latitude, res.coords.longitude);
      this.latUser = res.coords.latitude.toFixed(2);
      this.longUser = res.coords.latitude.toFixed(2);
      this.localizaUnits();
      loading.dismiss();
    }).catch((e) => {
      this.localizaUnits();
      console.log(e);
      loading.dismiss();
    })
  }


  async localizaUnits() {
    this.authService.units().subscribe((units) => {
      this.aux_unidade = units;

      // Incluir resultado do km no objeto
      for (let i = 0; i < this.aux_unidade.length; i++) {
        this.km = this.getDistanceFromLatLonInKm(this.aux_unidade[i].latitude, this.aux_unidade[i].longitude, this.latUser, this.longUser);


        this.aux_unidade[i].km = parseFloat(this.km);
        // this.aux_unidade[i].km = parseFloat(this.km.substr(0, 1));
      }

      // Buscar pelo menor km
      this.aux_unidade = this.aux_unidade.sort(function (a, b) {
        if (a.km < b.km) { return -1; }
        if (a.km > b.km) { return 1; }
        return 0;
      });

      console.log(this.aux_unidade);

      // Retornar para visualização na tela
      this.unidade = this.aux_unidade;
    })
  }

  // Calcular lat e long e retornar em Km
  getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
    var deg2rad = function (deg) { return deg * (Math.PI / 180); }
    var R = 6371; // Radius of the earth in km
    var dLat = deg2rad(lat2 - lat1);  // deg2rad below
    var dLon = deg2rad(lon2 - lon1);
    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var d = R * c; // Distance in km
    return d.toFixed(2);
  }
}
