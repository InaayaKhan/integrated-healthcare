package com.example.hca_doctorapp;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class UpdateProfile extends AppCompatActivity {

    Spinner spnSpecialized;

    EditText etName;
    EditText etMobile;
    EditText etExp;
    EditText etAddress;
    EditText etPincode;
    EditText etCity;

    String strName,strMobile, strSpecialized, strExp, strAddress, strPincode, strCity;

    private ProgressDialog pDialog;

    JSONParser jsonParser = new JSONParser();

    // url to create new product
    private static String url_update_profile = Common.server_url + "/appupdateprofile_doctor.php";

    // JSON Node names
    private static final String TAG_SUCCESS = "success";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_update_profile);

        getSupportActionBar().setTitle("Update Profile");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        etName = (EditText)findViewById(R.id.txtProfileName);
        etMobile = (EditText)findViewById(R.id.txtProfileNumber);

        spnSpecialized = (Spinner) findViewById(R.id.spnProfileNumberSpecialized);
        List<String> categories = new ArrayList<String>();
        categories.add("Select an Option");
        categories.add("Cardiologist");
        categories.add("Dentist");
        categories.add("Dermatologist");
        categories.add("Naturopath");
        categories.add("Neurologist");
        categories.add("Oncologist");
        categories.add("Pediatrician");
        ArrayAdapter<String> dataAdapter = new ArrayAdapter<String>(this, android.R.layout.simple_spinner_item, categories);
        dataAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spnSpecialized.setAdapter(dataAdapter);

        etExp = (EditText)findViewById(R.id.txtProfileExp);
        etAddress = (EditText)findViewById(R.id.txtProfileAddress);
        etPincode = (EditText)findViewById(R.id.txtProfilePincode);
        etCity = (EditText)findViewById(R.id.txtProfileCity);

        new getProfileInfo().execute();
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() == android.R.id.home) {
            finish();
        }
        return super.onOptionsItemSelected(item);
    }

    public void updateProfile(View v) {
        if(etName.getText().toString().trim().length()<=0) {
            Toast.makeText(this,"Enter your name",Toast.LENGTH_SHORT).show();
            etName.requestFocus();
        }
        else if(spnSpecialized.getSelectedItem().toString().trim().length()<=0) {
            Toast.makeText(this,"Select specialized in",Toast.LENGTH_SHORT).show();
            spnSpecialized.requestFocus();
        }
        else if(etExp.getText().toString().trim().length()<=0) {
            Toast.makeText(this,"Enter years of experience",Toast.LENGTH_SHORT).show();
            etExp.requestFocus();
        }
        else if(etAddress.getText().toString().trim().length()<=0) {
            Toast.makeText(this,"Enter address",Toast.LENGTH_SHORT).show();
            etAddress.requestFocus();
        }
        else if(etPincode.getText().toString().trim().length()<=0) {
            Toast.makeText(this,"Enter pin code",Toast.LENGTH_SHORT).show();
            etPincode.requestFocus();
        }
        else if(etCity.getText().toString().trim().length()<=0) {
            Toast.makeText(this,"Enter city",Toast.LENGTH_SHORT).show();
            etCity.requestFocus();
        }
        else {
            new funUpdateProfile().execute();
        }
    }

    class funUpdateProfile extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(UpdateProfile.this);
            pDialog.setMessage("Updating Profile.. Please Wait..");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }
        protected String doInBackground(String... args) {
            List<NameValuePair> params = new ArrayList<NameValuePair>();
            params.add(new BasicNameValuePair("name", etName.getText().toString().trim()));
            params.add(new BasicNameValuePair("specialized", spnSpecialized.getSelectedItem().toString().trim()));
            params.add(new BasicNameValuePair("exp", etExp.getText().toString().trim()));
            params.add(new BasicNameValuePair("address", etAddress.getText().toString().trim()));
            params.add(new BasicNameValuePair("pincode", etPincode.getText().toString().trim()));
            params.add(new BasicNameValuePair("city", etCity.getText().toString().trim()));
            params.add(new BasicNameValuePair("ID", Common.username));
            JSONObject json = jsonParser.makeHttpRequest(url_update_profile, "POST", params);
            try {
                int success = json.getInt(TAG_SUCCESS);
                final String message = json.getString("message");
                if (success == 1) {
                    Handler handler =  new Handler(getApplicationContext().getMainLooper());
                    handler.post( new Runnable(){
                        public void run(){
                            Toast.makeText(getApplicationContext(), message,Toast.LENGTH_SHORT).show();
                        }
                    });
                } else {
                    Handler handler =  new Handler(getApplicationContext().getMainLooper());
                    handler.post( new Runnable(){
                        public void run(){
                            Toast.makeText(getApplicationContext(),message, Toast.LENGTH_LONG).show();
                        }
                    });
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
            return null;
        }
        protected void onPostExecute(String file_url) {
            // dismiss the dialog once done
            pDialog.dismiss();
        }
    }

    class getProfileInfo extends AsyncTask<String,String,String> {
        protected void onPreExecute(){
            super.onPreExecute();
            pDialog = new ProgressDialog(UpdateProfile.this);
            pDialog.setMessage("Fetching profile info... Please wait...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }
        protected String doInBackground(String...args){
            List<NameValuePair> params= new ArrayList<NameValuePair>();
            String url_user_details =  Common.server_url + "/appgetprofileinfo_doctor.php";
            params.add(new BasicNameValuePair("ID", Common.username));
            JSONParser jParser = new JSONParser();
            JSONObject json = jParser.makeHttpRequest(url_user_details, "POST", params);
            try {
                JSONArray cat=json.getJSONArray("response");
                for(int i=0;i<cat.length();i++){
                    JSONObject jsonObject=cat.getJSONObject(i);
                    strName=jsonObject.getString("name");
                    strMobile=jsonObject.getString("mobile");
                    strSpecialized=jsonObject.getString("specialized");
                    strExp=jsonObject.getString("exp");
                    strAddress=jsonObject.getString("address");
                    strPincode=jsonObject.getString("pincode");
                    strCity=jsonObject.getString("city");
                }
            }catch (JSONException e){
                e.printStackTrace();
            }
            return null;
        }

        protected void onPostExecute(String file_url){
            etName.setText(strName);
            etMobile.setText(strMobile);
            spnSpecialized.setSelection(((ArrayAdapter<String>)spnSpecialized.getAdapter()).getPosition(strSpecialized));
            etExp.setText(strExp);
            etAddress.setText(strAddress);
            etPincode.setText(strPincode);
            etCity.setText(strCity);
            pDialog.dismiss();
        }
    }
}