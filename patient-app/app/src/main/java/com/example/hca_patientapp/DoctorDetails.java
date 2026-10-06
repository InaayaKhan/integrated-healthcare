package com.example.hca_patientapp;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class DoctorDetails extends AppCompatActivity {

    String doc_id;

    ProgressDialog pDialog;

    JSONArray jsonArray = null;

    String strName, strMobile, strExp, strAddress;

    TextView lblName, lblMobile, lblExp, lblAddress;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_doctor_details);

        getSupportActionBar().setTitle("Doctor Details");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        Bundle bundle = getIntent().getExtras();
        doc_id= bundle.getString("DoctorID");

        lblName = (TextView)findViewById(R.id.lblDoctorName);
        lblMobile = (TextView)findViewById(R.id.lblMobileNumber);
        lblExp = (TextView)findViewById(R.id.lblDetails);
        lblAddress = (TextView)findViewById(R.id.lblAddress);

        new getDoctorDetails().execute();
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() == android.R.id.home) {
            finish();
        }
        return super.onOptionsItemSelected(item);
    }

    public void funGoogleMeet(View v)
    {
        Intent i = new Intent(getApplicationContext(), BookAppointment.class);
        Bundle bundle = new Bundle();
        bundle.putString("DoctorID", doc_id);
        i.putExtras(bundle);
        startActivity(i);
    }

    public void funStartChat(View v)
    {

    }

    class getDoctorDetails extends AsyncTask<String,String,String> {
        protected void onPreExecute(){
            super.onPreExecute();
            pDialog = new ProgressDialog(DoctorDetails.this);
            pDialog.setMessage("Searching... Please wait...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }

        protected String doInBackground(String...args){
            List<NameValuePair> params= new ArrayList<NameValuePair>();
            String url_user_details =  Common.server_url + "appGetDoctorDetails.php";
            params.add(new BasicNameValuePair("doc_id", doc_id));
            JSONParser jParser = new JSONParser();
            JSONObject json = jParser.makeHttpRequest(url_user_details, "POST", params);
            try {
                JSONArray cat=json.getJSONArray("response");
                for(int i=0;i<cat.length();i++){
                    JSONObject jsonObject=cat.getJSONObject(i);
                    strName=jsonObject.getString("Name");
                    strMobile=jsonObject.getString("Mobile");
                    strExp=jsonObject.getString("Exp");
                    strAddress=jsonObject.getString("Address");
                }
            }catch (JSONException e){
                e.printStackTrace();
            }
            return null;
        }

        protected void onPostExecute(String file_url){

            lblName.setText(strName);
            lblMobile.setText("Mobile number: " + strMobile);
            lblExp.setText(strExp);
            lblAddress.setText(strAddress);

            pDialog.dismiss();
        }
    }
}