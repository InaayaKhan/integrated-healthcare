package com.example.hca_patientapp;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.util.Log;
import android.view.View;
import android.view.WindowManager;
import android.widget.EditText;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class CreateAccount extends AppCompatActivity {

    private ProgressDialog pDialog;

    JSONParser jsonParser = new JSONParser();

    // url to create new product
    private static String url_create_account = Common.server_url + "appregistration_patient.php";

    // JSON Node names
    private static final String TAG_SUCCESS = "success";

    EditText name;
    EditText contact;
    EditText pass;
    EditText retype;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_create_account);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        getSupportActionBar().hide();

        name = (EditText)findViewById(R.id.txtRName);
        contact = (EditText)findViewById(R.id.txtRContact);
        pass = (EditText)findViewById(R.id.txtRPassword);
        retype = (EditText)findViewById(R.id.txtRRetype);
    }

    public void register(View v)
    {
        if (name.getText().toString().length()<=0) {
            Toast.makeText(this, "Enter Name", Toast.LENGTH_SHORT).show();
            name.requestFocus();
        }
        else if(contact.getText().toString().length()<=0) {
            Toast.makeText(this,"Enter Contact Number", Toast.LENGTH_SHORT).show();
            contact.requestFocus();
        }
        else if(pass.getText().toString().length()<=0) {
            Toast.makeText(this,"Enter Password", Toast.LENGTH_SHORT).show();
            pass.requestFocus();
        }
        else if(retype.getText().toString().length()<=0) {
            Toast.makeText(this,"Retype Password", Toast.LENGTH_SHORT).show();
            retype.requestFocus();
        }
        else if(pass.getText().toString().equals(retype.getText().toString())==false) {
            Toast.makeText(this,"Password Mismatch, please Retype Password again", Toast.LENGTH_SHORT).show();
            retype.requestFocus();
        }
        else {
            //controller.insertUser(username,password);
            //Toast.makeText(this,"Account Created Successfully", Toast.LENGTH_SHORT).show();
            //Intent i = new Intent(this, Login.class);
            //startActivity(i);
            //finish();

            new NewUser().execute();
        }
    }

    class NewUser extends AsyncTask<String, String, String> {

        /**
         * Before starting background thread Show Progress Dialog
         * */
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(CreateAccount.this);
            pDialog.setMessage("Creating User.. Please Wait..");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }

        /**
         * Creating product
         * */
        protected String doInBackground(String... args) {

            String encName="";
            String encContact="";
            String encPass="";
            try {
                encName = name.getText().toString();
                encContact = contact.getText().toString();
                encPass = pass.getText().toString();
            }
            catch(Exception e)
            {}

            // Building Parameters
            List<NameValuePair> params = new ArrayList<NameValuePair>();
            params.add(new BasicNameValuePair("Name", encName));
            params.add(new BasicNameValuePair("MobileNumber", encContact));
            params.add(new BasicNameValuePair("Password", encPass));

            // getting JSON Object
            // Note that create product url accepts POST method
            JSONObject json = jsonParser.makeHttpRequest(url_create_account, "POST", params);

            // check log cat fro response
            Log.d("Create Response", json.toString());

            // check for success tag
            try {
                int success = json.getInt(TAG_SUCCESS);
                final String message = json.getString("message");
                if (success == 1) {
                    // successfully created product
                    //Toast.makeText(getApplicationContext(),"Account Created Successfully", Toast.LENGTH_SHORT).show();
                    Handler handler =  new Handler(getApplicationContext().getMainLooper());
                    handler.post( new Runnable(){
                        public void run(){
                            Toast.makeText(getApplicationContext(), message,Toast.LENGTH_SHORT).show();
                        }
                    });
                    Intent i = new Intent(getApplicationContext(), Login.class);
                    startActivity(i);
                    finish();
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

        /**
         * After completing background task Dismiss the progress dialog
         * **/
        protected void onPostExecute(String file_url) {
            // dismiss the dialog once done
            pDialog.dismiss();
        }

    }

    public void backToLogin(View v)
    {
        Intent i = new Intent(getApplicationContext(), Login.class);
        startActivity(i);
        finish();
    }
}
