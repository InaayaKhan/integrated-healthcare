package com.example.hca_patientapp;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
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

    EditText etName;
    EditText etMobile;
    EditText etAddress;
    EditText etPincode;
    EditText etCity;

    String strName,strMobile, strAddress, strPincode, strCity;

    private ProgressDialog pDialog;

    JSONParser jsonParser = new JSONParser();

    // url to create new product
    private static String url_update_profile = Common.server_url + "/appupdateprofile_patient.php";

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
            String url_user_details =  Common.server_url + "/appgetprofileinfo_patient.php";
            params.add(new BasicNameValuePair("ID", Common.username));
            JSONParser jParser = new JSONParser();
            JSONObject json = jParser.makeHttpRequest(url_user_details, "POST", params);
            try {
                JSONArray cat=json.getJSONArray("response");
                for(int i=0;i<cat.length();i++){
                    JSONObject jsonObject=cat.getJSONObject(i);
                    strName=jsonObject.getString("name");
                    strMobile=jsonObject.getString("mobile");
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
            etAddress.setText(strAddress);
            etPincode.setText(strPincode);
            etCity.setText(strCity);
            pDialog.dismiss();
        }
    }
}