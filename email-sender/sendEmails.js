const fs = require("fs");
const csv = require("csv-parser");
const nodemailer = require("nodemailer");
require("dotenv").config();

// Email transporter (Gmail)
const transporter = nodemailer.createTransport({
  service: "gmail",
  auth: {
    user: process.env.GMAIL_USER,
    pass: process.env.GMAIL_APP_PASSWORD,
  },
});

// Email Template
function createEmail(name, company) {
  return {
    subject: `Exploring Full Stack / Backend Developer Opportunities`,
    html: `
      <p>Dear ${name},</p>

      <p>I hope you are doing well.</p>

      <p>
        I am reaching out to explore any current or upcoming opportunities for a 
        <strong>Full Stack / Backend Developer</strong> at <strong>${company}</strong>.
        I have experience in building scalable web applications, REST APIs, 
        and admin panels.
      </p>

      <p>
        Please find my resume attached for your reference.
        I would appreciate your guidance if there is a suitable opportunity.
      </p>

      <p>
        Warm regards,<br/>
        <strong>Yuvraj Kohli</strong><br/>
        Full Stack Developer<br/>
        📧 yuvrajkohli8090ylt@gmail.com
      </p>
    `,
  };
}

// Read CSV and Send Emails
fs.createReadStream("hr_list.csv")
  .pipe(csv())
  .on("data", async (row) => {
    const mail = createEmail(row.Name, row.Company);

    try {
      await transporter.sendMail({
        from: `"Yuvraj Kohli" <${process.env.GMAIL_USER}>`,
        to: row.Email,
        subject: mail.subject,
        html: mail.html,
        attachments: [
          {
            filename: "Yuvraj_Kohli_Full_Stack_Developer.pdf",
            path: "./Yuvraj_Kohli_Full_Stack_Developer.pdf",
          },
        ],
      });

      console.log(`✅ Email sent to ${row.Email}`);
    } catch (err) {
      console.error(`❌ Failed for ${row.Email}`, err.message);
    }
  })
  .on("end", () => {
    console.log("📨 All emails processed.");
  });
