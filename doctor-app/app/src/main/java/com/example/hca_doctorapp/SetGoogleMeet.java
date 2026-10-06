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
import android.widget.EditText;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class SetGoogleMeet extends AppCompatActivity {

    EditText etLink;

    private ProgressDialog pDialog;

    JSONParser jsonParser = new JSONParser();

    // url to create new product
    private static String url_update_link = Common.server_url + "/appsavevclink_doctor.php";

    // JSON Node names
    private static final String TAG_SUCCESS = "success";

    String link="";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_set_google_meet);

        getSupportActionBar().setTitle("Video Conference Setup");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        etLink = (EditText) findViewById(R.id.txtLink);

        new getLink().execute();
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() == android.R.id.home) {
            finish();
        }
        return super.onOptionsItemSelected(item);
    }

    public void saveLink(View v) {
        if(etLink.getText().toString().trim().length()<=0) {
            Toast.makeText(this,"Enter Video Conference Link",Toast.LENGTH_SHORT).show();
            etLink.requestFocus();
        }
        else {
            new updateLink().execute();
        }
    }

    class updateLink extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(SetGoogleMeet.this);
            pDialog.setMessage("Updating Link.. Please Wait..");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }
        protected String doInBackground(String... args) {
            List<NameValuePair> params = new ArrayList<NameValuePair>();
            params.add(new BasicNameValuePair("link", etLink.getText().toString().trim()));
            params.add(new BasicNameValuePair("ID", Common.username));
            JSONObject json = jsonParser.makeHttpRequest(url_update_link, "POST", params);
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
            pDialog.dismiss();
        }
    }

    class getLink extends AsyncTask<String,String,String> {
        protected void onPreExecute(){
            super.onPreExecute();
            pDialog = new ProgressDialog(SetGoogleMeet.this);
            pDialog.setMessage("Fetching link... Please wait...");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }
        protected String doInBackground(String...args){
            List<NameValuePair> params= new ArrayList<NameValuePair>();
            String url_user_details =  Common.server_url + "/appgetvclink_doctor.php";
            params.add(new BasicNameValuePair("ID", Common.username));
            JSONParser jParser = new JSONParser();
            JSONObject json = jParser.makeHttpRequest(url_user_details, "POST", params);
            try {
                JSONArray cat=json.getJSONArray("response");
                for(int i=0;i<cat.length();i++){
                    JSONObject jsonObject=cat.getJSONObject(i);
                    link=jsonObject.getString("link");
                }
            }catch (JSONException e){
                e.printStackTrace();
            }
            return null;
        }

        protected void onPostExecute(String file_url){
            etLink.setText(link);
            pDialog.dismiss();
        }
    }
}