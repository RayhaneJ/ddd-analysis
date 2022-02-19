using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Wellcome.DataModel
{
    [Table("User")]
    public class User
    {
        public int ID { get; set; }
        public string Uuid { get; set; }
        public int ContactId { get; set; }
        public virtual Contact Contact { get; set; }
        public string Profession { get; set; }
        public string Description { get; set; }
        public int Age { get; set; }
        public Gender Gender { get; set; }
        public string Language { get; set; }
        public DateTime BirthDate { get; set; }
        public string Password { get; set; }
        public virtual List<FavoriteHost> FavoriteHosts { get; set; }
        public virtual List<HostReservation> HostReservations { get; set; }
        public virtual List<Feedback> Feedbacks { get; set; }
        public virtual List<Host> Hosts { get; set; }
        public virtual ProfilePicture ProfilePicture { get; set; }
    }

    public enum Gender
    {
        Male, Female
    }
}
