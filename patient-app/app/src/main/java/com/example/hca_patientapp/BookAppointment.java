package com.example.hca_patientapp;

import androidx.appcompat.app.AppCompatActivity;

import android.app.AlertDialog;
import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.icu.text.SimpleDateFormat;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.text.format.Time;
import android.view.MenuItem;
import android.view.View;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

public class BookAppointment extends AppCompatActivity {

    DatePicker dpDatePicker;
    EditText etReason;

    private ProgressDialog pDialog;

    JSONParser jsonParser = new JSONParser();

    // url to create new product
    private static String url_update_profile = Common.server_url + "/appBookAppointment.php";

    // JSON Node names
    private static final String TAG_SUCCESS = "success";

    String doc_id;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_book_appointment);

        getSupportActionBar().setTitle("Request an Appointment");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        Bundle bundle = getIntent().getExtras();
        doc_id= bundle.getString("DoctorID");

        dpDatePicker = (DatePicker)findViewById(R.id.txtAppointmentDate);
        long now = System.currentTimeMillis() - 1000;
        dpDatePicker.setMinDate(now);
        dpDatePicker.setMaxDate(now+(1000*60*60*24*15));

        etReason = (EditText) findViewById(R.id.txtAppointmentReason);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        if (item.getItemId() == android.R.id.home) {
            finish();
        }
        return super.onOptionsItemSelected(item);
    }

    public void bookAppointment(View v)
    {
        if (etReason.getText().toString().length()<=0) {
            Toast.makeText(this, "Enter Appointment Reason", Toast.LENGTH_SHORT).show();
            etReason.requestFocus();
        }
        else {
            int day = dpDatePicker.getDayOfMonth();
            int month = dpDatePicker.getMonth()+1;
            int year = dpDatePicker.getYear();

            String strDate = day + "-" + month + "-" + year;
            new AlertDialog.Builder(this)
                    .setTitle("Book Appointment")
                    .setMessage("Do you really want to book an online google meet on " + strDate + " ?")
                    .setIcon(android.R.drawable.ic_dialog_alert)
                    .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog, int whichButton) {
                            new funBookAppointment().execute();
                        }})
                    .setNegativeButton(android.R.string.no, null).show();
        }
    }

    class funBookAppointment extends AsyncTask<String, String, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(BookAppointment.this);
            pDialog.setMessage("Booking Appointment.. Please Wait..");
            pDialog.setIndeterminate(false);
            pDialog.setCancelable(false);
            pDialog.show();
        }
        protected String doInBackground(String... args) {
            int day = dpDatePicker.getDayOfMonth();
            int month = dpDatePicker.getMonth()+1;
            int year = dpDatePicker.getYear();

            String strDate = year + "-" + month + "-" + day;
            List<NameValuePair> params = new ArrayList<NameValuePair>();
            params.add(new BasicNameValuePair("doctorID", doc_id));
            params.add(new BasicNameValuePair("patientID", Common.username));
            params.add(new BasicNameValuePair("appointmentDate", strDate));
            params.add(new BasicNameValuePair("appointmentReason", etReason.getText().toString().trim()));

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
                    Intent i = new Intent(getApplicationContext(), MainActivity.class);
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
        protected void onPostExecute(String file_url) {
            // dismiss the dialog once done
            pDialog.dismiss();
        }
    }
}