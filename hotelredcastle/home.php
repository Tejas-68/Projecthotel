<?php

include 'config.php';
session_start();

// page redirect
$usermail = "";
$usermail = $_SESSION['usermail'];
if ($usermail == true) {

} else {
  header("location: index.php");
  exit();//i created
}

// if (isset($_POST['cancel_booking'])) {
//   $cancel_id = $_POST['cancel_id'];

//   $update = "UPDATE roombook SET stat = 'Cancelled' WHERE id = '$cancel_id'";
//   if (mysqli_query($conn, $update)) {
//     echo "<script>
//           alert('Your booking has been successfully cancelled. Refund will be initiated within 7 working days to your bank.');
//       </script>";
//   } else {
//     echo "<script>
//           alert('Error: Could not cancel the booking. Please try again.');
//       </script>";
//   }
// }

if (isset($_POST['cancel_booking'])) {
  $cancel_id = $_POST['cancel_id'];

  // Prepare the SQL statement
  $stmt = $conn->prepare("UPDATE roombook SET stat = 'Cancelled' WHERE id = ?");
  $stmt->bind_param("i", $cancel_id); // "i" means integer

  if ($stmt->execute()) {
    echo "<script>
              alert('Your booking has been successfully cancelled. Refund will be initiated within 7 working days to your bank.');
            </script>";
  } else {
    echo "<script>
              alert('Error: Could not cancel the booking. Please try again.');
            </script>";
  }

  $stmt->close();
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/home.css">
  <title>Hotel Red Castle</title>
  <!-- boot -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <!-- fontowesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- sweet alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="./admin/css/roombook.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    #guestdetailpanel {
      display: none;
    }

    #guestdetailpanel .middle {
      height: 450px;
    }
  </style>
  <style>
    /* ------ our rooms css ---- */
    /* Modal styles */
    .modal {
      display: none;
      /* Hidden by default */
      position: fixed;
      z-index: 1;
      /* Sit on top */
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.4);
      /* Black with opacity */
      overflow: auto;
    }

    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }

    .btn {
      background-color: #007bff;
      /* Blue background */
      color: white;
      /* White text */
      padding: 10px 20px;
      /* Add padding */
      border: none;
      /* Remove border */
      border-radius: 5px;
      /* Optional: Rounded corners */
      cursor: pointer;
      /* Make it look clickable */
    }

    .btn:hover {
      background-color: #0056b3;
      /* Darker blue on hover */
    }

    /* --------------- facility css ------------ */
    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      padding-top: 60px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: white;
      margin: auto;
      padding: 20px;
      border-radius: 10px;
      width: 80%;
      max-width: 500px;
    }

    .close {
      float: right;
      font-size: 24px;
      font-weight: bold;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <nav>
    <div class="logo">
      <img class="bluebirdlogo" src="./image/hotelredcastlelogo.png" alt="logo">
      <p>HOTEL RED CASTLE</p>
    </div>
    <ul>
      <li><a href="#firstsection">Home</a></li>
      <li><a href="#secondsection">Rooms</a></li>
      <li><a href="#thirdsection">Facilites</a></li>
      <li><a href="#mybookings">My Booking</a></li>
      <li><a href="#contactus">contact us</a></li>
      <li><a href="./logout.php"><button class="btn btn-danger">Logout</button></a></li>
    </ul>
  </nav>

  <section id="firstsection" class="carousel slide carousel_section" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="carousel-image" src="./image/hotel1.jpg">
      </div>
      <div class="carousel-item">
        <img class="carousel-image" src="./image/hotel2.jpg">
      </div>
      <div class="carousel-item">
        <img class="carousel-image" src="./image/hotel3.jpg">
      </div>
      <div class="carousel-item">
        <img class="carousel-image" src="./image/hotel4.jpg">
      </div>

      <div class="welcomeline">
        <h1 class="welcometag">Welcome to heaven on earth</h1>
      </div>

      <!-- bookbox -->
      <div id="guestdetailpanel">
        <form action="" method="POST" class="guestdetailpanelform">
          <div class="head">
            <h3>RESERVATION</h3>
            <i class="fa-solid fa-circle-xmark" onclick="closebox()"></i>
          </div>
          <div class="middle">
            <div class="guestinfo">
              <h4>Guest information</h4>
              <input type="text" name="Name" placeholder="Enter Full name"
                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g,'')" required>
              <input type="email" name="Email" placeholder="Enter Email" required>
              <select name="Country" class="selectinput">
                <option value selected>Select your country</option>
                <?php
                $countries = array("India", "United States", "Canada", "Australia", "Germany", "France", "Japan", "United Kingdom", "Brazil", "Mexico");
                foreach ($countries as $value) {
                  echo '<option value="' . $value . '">' . $value . '</option>';
                }
                ?>
              </select>
              <input type="tel" name="Phone" placeholder="Enter Phone no" minlength="10" maxlength="10" required>
              <input type="text" name="Aadhar" placeholder="Enter Aadhar Card Number" pattern="^[0-9]{12}$"
                title="Please enter a valid 12-digit Aadhar number"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>

            </div>

            <div class="line"></div>

            <div class="reservationinfo">
              <h4>Reservation information</h4>
              <select name="RoomType" class="selectinput" onchange="updateTotal()">
                <option value selected>Type Of Room</option>
                <option value="Superior Room">SUPERIOR ROOM</option>
                <option value="Deluxe Room">DELUXE ROOM</option>
                <option value="Guest House">GUEST HOUSE</option>
                <option value="Single Room">SINGLE ROOM</option>
              </select>
              <select name="Bed" class="selectinput" onchange="updateTotal()">
                <option value selected>Bedding Type</option>
                <option value="Single">Single</option>
                <option value="Double">Double</option>
                <option value="Triple">Triple</option>
                <option value="Quad">Quad</option>
                <option value="None">None</option>
              </select>
              <select name="NoofRoom" class="selectinput" onchange="updateTotal()">
                <option value selected>No of Room</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
              <select name="Meal" class="selectinput" onchange="updateTotal()">
                <option value selected>Meal</option>
                <option value="Room only">Room only</option>
                <option value="Breakfast">Breakfast</option>
                <option value="Half Board">Half Board</option>
                <option value="Full Board">Full Board</option>
              </select>
              <div class="datesection">
                <span>
                  <label for="cin"> Check-In</label>
                  <input name="cin" type="date" onchange="updateTotal()">
                </span>
                <span>
                  <label for="cout"> Check-Out</label>
                  <input name="cout" type="date" onchange="updateTotal()">
                </span>
              </div>
            </div>
          </div>
          <div class="footer" style="display: flex; justify-content: space-between; align-items: center;">
            <div style="font-weight: bold; font-size: 16px; color: #333;">
              Total Amount: ₹<span id="totalAmountDisplay">0</span>
            </div>
            <button type="button" class="btn btn-success" onclick="handlePayment()">Submit</button>
            <input type="hidden" name="guestdetailsubmit" value="1">
          </div>
        </form>

        <!-- JavaScript -->
        <script>
          function calculateTotalAmount() {
            const form = document.querySelector(".guestdetailpanelform");

            const roomType = form.querySelector("select[name='RoomType']").value;
            const bedType = form.querySelector("select[name='Bed']").value;
            const mealType = form.querySelector("select[name='Meal']").value;
            const numberOfRooms = parseInt(form.querySelector("select[name='NoofRoom']").value) || 0;

            const checkIn = new Date(form.querySelector("input[name='cin']").value);
            const checkOut = new Date(form.querySelector("input[name='cout']").value);
            const numberOfDays = Math.max(1, Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24)));

            const roomPrices = {
              "Superior Room": 3000,
              "Deluxe Room": 2000,
              "Guest House": 1500,
              "Single Room": 1000
            };

            const bedPrices = {
              "Single": 0.01,
              "Double": 0.02,
              "Triple": 0.03,
              "Quad": 0.04,
              "None": 0
            };

            const mealPrices = {
              "Room only": 0,
              "Breakfast": 2,
              "Half Board": 3,
              "Full Board": 4
            };

            if (!roomType || !bedType || !mealType || !checkIn || !checkOut || !numberOfRooms) return 0;

            const roomPrice = roomPrices[roomType] || 0;
            const bedPricePercentage = bedPrices[bedType] || 0;
            const mealMultiplier = mealPrices[mealType] || 0;

            const roomTotal = roomPrice * numberOfRooms * numberOfDays;
            const bedTotal = (roomPrice * bedPricePercentage) * numberOfRooms * numberOfDays;
            const mealTotal = (roomPrice * bedPricePercentage * mealMultiplier) * numberOfRooms * numberOfDays;

            const finalTotal = roomTotal + bedTotal + mealTotal;

            return finalTotal > 0 ? Math.round(finalTotal) : 0;
          }

          function updateTotal() {
            const total = calculateTotalAmount();
            document.getElementById("totalAmountDisplay").innerText = total;
          }

          function handlePayment() {
            const totalAmount = calculateTotalAmount();

            if (totalAmount === 0) {
              alert("Please complete your reservation selections before proceeding to payment.");
              return;
            }

            if (confirm("Proceed to payment?")) {
              showFakePayment(totalAmount).then(success => {
                if (success) {
                  alert("Payment successful!");
                  document.querySelector(".guestdetailpanelform").submit();
                  closebox();
                } else {
                  alert("Payment failed.");
                }
              });
            }
          }

          function showFakePayment(totalAmount) {
            return new Promise(resolve => {
              const paymentWindow = window.open("", "Payment", "width=500,height=600");

              const html = `
                <html>
                    <head><title>Payment</title></head>
                    <body style="font-family: sans-serif; text-align: center; padding-top: 30px;">
                        <h2>Payment Gateway</h2>
                        <p style="margin: 20px;">Total Amount: <strong>₹${totalAmount}</strong></p>
                        <h4>Enter Payment Details</h4>
                        <div style="margin: 15px;">
                            <input type="text" placeholder="Card no" maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required style="padding: 8px; width: 80%; margin: 5px;"><br>
                            <input type="text" placeholder="Name on Card" required style="padding: 8px; width: 80%; margin: 5px;"><br>
                            <input type="text" placeholder="Expiry (MM/YY)" pattern="(0[1-9]|1[0-2])\/\d{2}" required style="padding: 8px; width: 80%; margin: 5px;"><br>
                            <input type="number" placeholder="CVV" maxlength="3" style="padding: 8px; width: 80%; margin: 5px;"><br>
                        </div>
                        <button onclick="window.opener.finishPayment(true); window.close();" 
                            style="padding: 10px 30px; background: green; color: white; border: none; font-size: 16px; cursor: pointer;">
                            Pay ₹${totalAmount}
                        </button>
                        <p style="margin-top: 20px; font-size: 12px;"></p>
                    </body>
                </html>
            `;

              paymentWindow.document.write(html);
              window.finishPayment = resolve;
            });
          }

          function closebox() {
            document.getElementById("guestdetailpanel").style.display = "none";
          }
        </script>
      </div>



      <!-- ==== room book php ====-->
      <?php
      if (isset($_POST['guestdetailsubmit'])) {
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Country = $_POST['Country'];
        $Phone = $_POST['Phone'];
        $Aadhar = $_POST['Aadhar'];
        $RoomType = $_POST['RoomType'];
        $Bed = $_POST['Bed'];
        $NoofRoom = $_POST['NoofRoom'];
        $Meal = $_POST['Meal'];
        $cin = $_POST['cin'];
        $cout = $_POST['cout'];

        if ($Name == "" || $Email == "" || $Country == "") {
          echo "<script>swal({
                        title: 'Fill the proper details',
                        icon: 'error',
                    });
                    </script>";
        } else {
          $sta = "NotConfirm";
          $sql = "INSERT INTO roombook(Name,Email,Country,Phone,Aadhar,RoomType,Bed,NoofRoom,Meal,cin,cout,stat,nodays)
        VALUES ('$Name','$Email','$Country','$Phone','$Aadhar','$RoomType','$Bed','$NoofRoom','$Meal','$cin','$cout','$sta',datediff('$cout','$cin'))";
          $result = mysqli_query($conn, $sql);


          if ($result) {
            echo "<script>swal({
                                title: 'Reservation successful',
                                icon: 'success',
                            });
                        </script>";
          } else {
            echo "<script>swal({
                                    title: 'Something went wrong',
                                    icon: 'error',
                                });
                        </script>";
          }
        }
      }
      ?>
    </div>

    </div>
  </section>

  <section id="secondsection">
    <img src="./image/homeanimatebg.svg">
    <div class="ourroom">
      <h1 class="head">≼ Our room ≽</h1>
      <div class="roomselect">
        <div class="roombox">
          <div class="hotelphoto h1"></div>
          <div class="roomdata">
            <h2>Superior Room</h2>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
              <i class="fa-solid fa-spa"></i>
              <i class="fa-solid fa-dumbbell"></i>
              <i class="fa-solid fa-person-swimming"></i>
            </div>
            <button class="btn btn-primary bookbtn" onclick="showRoomDetails('superior')">Details</button>
            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
        <div class="roombox">
          <div class="hotelphoto h2"></div>
          <div class="roomdata">
            <h2>Deluxe Room</h2>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
              <i class="fa-solid fa-spa"></i>
              <i class="fa-solid fa-dumbbell"></i>
            </div>
            <button class="btn btn-primary bookbtn" onclick="showRoomDetails('deluxe')">Details</button>
            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
        <div class="roombox">
          <div class="hotelphoto h3"></div>
          <div class="roomdata">
            <h2>Guest Room</h2>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
              <i class="fa-solid fa-spa"></i>
            </div>
            <button class="btn btn-primary bookbtn" onclick="showRoomDetails('guest')">Details</button>
            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
        <div class="roombox">
          <div class="hotelphoto h4"></div>
          <div class="roomdata">
            <h2>Single Room</h2>
            <div class="services">
              <i class="fa-solid fa-wifi"></i>
              <i class="fa-solid fa-burger"></i>
            </div>
            <button class="btn btn-primary bookbtn" onclick="showRoomDetails('single')">Details</button>
            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Popup for Room Details -->
  <div id="roomDetailsModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeRoomDetails()">&times;</span>
      <h2 id="roomTitle"></h2>
      <div id="roomFeatures"></div>
      <div id="roomDescription"></div>
      <div id="roomImage"></div>
    </div>
  </div>


  <section id="thirdsection">
    <h1 class="head">≼ Facilities ≽</h1>
    <div class="facility">
      <div class="box" onclick="showFacilityDetails('pool')">
        <h2>Swimming Pool</h2>
      </div>
      <div class="box" onclick="showFacilityDetails('spa')">
        <h2>Spa</h2>
      </div>
      <div class="box" onclick="showFacilityDetails('restaurant')">
        <h2>24×7 Restaurants</h2>
      </div>
      <div class="box" onclick="showFacilityDetails('gym')">
        <h2>24×7 Gym</h2>
      </div>
      <div class="box" onclick="showFacilityDetails('heli')">
        <h2>Heli Service</h2>
      </div>
    </div>

  </section>

  <div id="facilityModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeFacilityDetails()">&times;</span>
      <h2 id="facilityTitle"></h2>
      <p id="facilityDescription"></p>
    </div>
  </div>


  <!-- My Bookings Section -->
  <section id="mybookings" class="py-5 bg-light">
    <div class="container">
      <h2 class="mb-4">My Bookings</h2>

      <?php
      $user = $_SESSION['usermail'];
      $bookings = mysqli_query($conn, "SELECT * FROM roombook WHERE Email = '$user'");

      if (mysqli_num_rows($bookings) > 0) {
        ?>
        <table class="table table-bordered table-hover">
          <thead class="table-dark">
            <tr>
              <th>Room Type</th>
              <th>Check-In</th>
              <th>Check-Out</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($bookings)) { ?>
              <tr>
                <td><?php echo $row['RoomType']; ?></td>
                <td><?php echo $row['cin']; ?></td>
                <td><?php echo $row['cout']; ?></td>
                <td><?php echo $row['stat']; ?></td>
                <td>
                  <?php if ($row['stat'] != 'Cancelled') { ?>
                    <form method="POST" style="display:inline;">
                      <input type="hidden" name="cancel_id" value="<?php echo $row['id']; ?>">
                      <button type="submit" name="cancel_booking" class="btn btn-danger btn-sm">Cancel</button>
                    </form>
                  <?php } else { ?>
                    <span class="text-danger fw-bold">Cancelled</span>
                  <?php } ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php
      } else {
        echo "<p>You have no bookings.</p>";
      }
      ?>
    </div>
  </section>

  <<section id="contactus">
    <div class="social">
      <a href="https://www.instagram.com/w3b.tejz" target="_blank">
        <i class="fa-brands fa-instagram"></i>
      </a>
      <a href="mailto:tejut1306@gmail.com">
        <i class="fa-solid fa-envelope"></i>
      </a>
      <a href="www.linkedin.com/in/tejas-n-c-a74804332" target="_blank">
        <i class="fa-brands fa-linkedin"></i>
      </a>
      <a href="https://github.com/Tejas-68" target="_blank">
        <i class="fa-brands fa-github"></i>
      </a>
    </div>
    <div class="createdby">
      <h5>Created by Tejas N C</h5>
    </div>
  </section>


  <script>
    function showRoomDetails(roomType) {
      const roomDetails = {
        superior: {
          title: "Superior Room",
          features: [
            '<i class="fa-solid fa-wifi"></i> Wi-Fi',
            '<i class="fa-solid fa-tv"></i> TV',
            '<i class="fa-solid fa-fire"></i> Room Heater',
            '<i class="fa-solid fa-snowflake"></i> Air Conditioning',
            '<i class="fa-solid fa-wine-bottle"></i> Mini Fridge',
            '<i class="fa-solid fa-person-swimming"></i> Swimming Pool Access'
          ],
          description: "A luxurious room with modern amenities, designed for your comfort.",
          image: "image/hotel1photo.webp" // Add actual image path
        },
        deluxe: {
          title: "Deluxe Room",
          features: [
            '<i class="fa-solid fa-wifi"></i> Wi-Fi',
            '<i class="fa-solid fa-tv"></i> TV',
            '<i class="fa-solid fa-fire"></i> Room Heater',
            '<i class="fa-solid fa-snowflake"></i> Air Conditioning',
            '<i class="fa-solid fa-wine-bottle"></i> Mini Fridge'
          ],
          description: "A deluxe room offering extra space and premium services.",
          image: "image/hotel2photo.jpg" // Add actual image path
        },
        guest: {
          title: "Guest Room",
          features: [
            '<i class="fa-solid fa-wifi"></i> Wi-Fi',
            '<i class="fa-solid fa-tv"></i> TV',
            '<i class="fa-solid fa-fire"></i> Room Heater'
          ],
          description: "A cozy room perfect for short stays with basic amenities.",
          image: "image/hotel3photo.avif" // Add actual image path
        },
        single: {
          title: "Single Room",
          features: [
            '<i class="fa-solid fa-wifi"></i> Wi-Fi',
            '<i class="fa-solid fa-tv"></i> TV'
          ],
          description: "A compact room ideal for solo travelers.",
          image: "image/hotel4photo.jpg" // Add actual image path
        }
      };

      const room = roomDetails[roomType];

      // Update modal content with room details
      document.getElementById("roomTitle").textContent = room.title;
      document.getElementById("roomFeatures").innerHTML = room.features.map(feature => `<li>${feature}</li>`).join('');
      document.getElementById("roomDescription").textContent = room.description;
      document.getElementById("roomImage").innerHTML = `<img src="${room.image}" alt="${room.title}" style="width:100%; height:auto;">`;

      // Show the modal
      document.getElementById("roomDetailsModal").style.display = "block";
    }

    function closeRoomDetails() {
      document.getElementById("roomDetailsModal").style.display = "none";
    }

    //--------fecelity javascript---------------
    function showFacilityDetails(type) {
      const facilities = {
        pool: {
          title: "Swimming Pool",
          description: "Dive into Luxury\nExperience the ultimate in relaxation and leisure at our beautifully designed, temperature-controlled swimming pool. Whether you're taking a refreshing dip after a long journey or simply soaking up the sun on our comfortable lounge chairs, our pool area is your personal oasis.\nSurrounded by elegant landscaping and ambient lighting, it's the perfect spot for morning laps, afternoon chill-outs, or an evening swim under the stars. With attentive poolside service, fresh towels, and refreshing drinks available on request, every moment here feels like a vacation within a vacation.\n🕒 Open Daily: 6 AM – 10 PM💧 Hygienically maintained | 👨‍👩‍👧 Family Friendly |\n🍹 Poolside Beverages Available"
        },
        spa: {
          title: "Spa",
          description: "Rejuvenate Your Body and Soul\nStep into serenity at our world-class spa, where relaxation meets luxury. From calming aromatherapy sessions to deep tissue massages, our expert therapists tailor each treatment to your needs, helping you unwind, restore energy, and elevate your mood.\nThe tranquil ambiance, soothing music, and aromatic scents create a sanctuary away from the hustle of daily life. Whether you're indulging in a solo escape or a couple’s retreat, our spa is designed to melt your stress away and leave you feeling completely renewed.\n🌿 Services Include: Massages | Facials | Body Scrubs | Steam Room\n🕒 Open Daily: 8 AM – 9 PM\n✨ Advance booking recommended for personalized sessions"
        },
        restaurant: {
          title: "24×7 Restaurants",
          description: "Savor Every Moment, Any Time\nCravings don’t keep a schedule — and neither do we. Our 24×7 multi-cuisine restaurant is always open to serve you delicious, freshly prepared meals at any hour of the day or night. Whether it’s an early breakfast, a late dinner, or a midnight snack, our chefs are ready to delight your taste buds.\nChoose from a diverse menu that spans global flavors and local favorites, all crafted with the finest ingredients and utmost care. Enjoy a relaxed ambiance, attentive service, and the freedom to dine whenever you desire — because great food shouldn’t wait.\n🍛 Highlights: Continental | Indian | Asian | Vegan Options\n🪑 Dine-In, Room Service & Takeaway Available\n🕒 Open 24 Hours | 📞 Order anytime"
        },
        gym: {
          title: "24×7 Gym",
          description: "Stay Fit. Anytime. Anywhere.\nYour fitness goals don’t take a vacation — and neither does our gym. Open 24×7, our modern fitness center is fully equipped with state-of-the-art cardio machines, free weights, and strength training equipment to keep you energized and active throughout your stay.\nWhether you prefer an early morning workout or a late-night sweat session, our gym offers a clean, safe, and motivating environment to help you stay on track. With climate control, full-length mirrors, and ample space, your workout will feel as premium as your stay.\n🏋️ Facilities: Treadmills | Dumbbells | Cross Trainers | Yoga Mats\n🕒 Open 24/7 | 🚿 Showers & Changing Rooms Available\n🧍 Personal trainer available on request"
        },
        heli: {
          title: "Heli Service",
          description: "Fly in Style and Comfort\nElevate your experience with our exclusive Helicopter Service. Skip the traffic, avoid long travel times, and arrive in style — whether you're heading to a business meeting, a scenic tour, or exploring nearby destinations.\nOur fleet of luxury helicopters offers you a fast, safe, and unforgettable way to travel. Enjoy panoramic views from above as you soar across breathtaking landscapes, making every journey a remarkable adventure.\n✨ Available for Private Transfers | Scenic Tours | Airport Pickups\n🕒 Service Available: (Subject to Availability)\n🌍 Customized Flight Packages Available\n🛩️ Comfort | Safety | Privacy"
        }
      };
     

      const data = facilities[type];
      if (data) {
        document.getElementById("facilityTitle").textContent = data.title;
        document.getElementById("facilityDescription").textContent = data.description;
        document.getElementById("facilityModal").style.display = "block";
      }
    }

    function closeFacilityDetails() {
      document.getElementById("facilityModal").style.display = "none";
    }

  </script>


</body>

<script>

  var bookbox = document.getElementById("guestdetailpanel");

  openbookbox = () => {
    bookbox.style.display = "flex";
  }
  closebox = () => {
    bookbox.style.display = "none";
  }
</script>

</html>