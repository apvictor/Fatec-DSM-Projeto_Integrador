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

  unidade: any[];
  aux_unidade: any = [];

  minhaPosicao: google.maps.LatLng;
  unitPosicao: google.maps.LatLng;

  km;
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
      this.minhaPosicao = new google.maps.LatLng(res.coords.latitude, res.coords.longitude);
      console.log(res.coords.latitude, res.coords.longitude);

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

      // Incluir resultado do km no array
      for (let i = 0; i < this.aux_unidade.length; i++) {
        this.unitPosicao = new google.maps.LatLng(this.aux_unidade[i].latitude, this.aux_unidade[i].longitude);
        this.km = (google.maps.geometry.spherical.computeDistanceBetween(this.minhaPosicao, this.unitPosicao) / 1000).toFixed(2);

        this.aux_unidade[i].km = parseFloat(this.km);
      }

      // Buscar pelo menor km
      this.aux_unidade = this.aux_unidade.sort(function (a, b) {
        if (a.km < b.km) { return -1; }
        if (a.km > b.km) { return 1; }
        return 0;
      });

      // Retornar para visualização na tela
      this.unidade = this.aux_unidade;
    })
  }

}
