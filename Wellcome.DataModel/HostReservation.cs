using System.ComponentModel.DataAnnotations.Schema;

namespace Wellcome.DataModel
{
    [Table("HostReservation")]
    public class HostReservation
    {
        public int UserId { get; set; }
        public User User { get; set; }

        public int HostId { get; set; }
        public Host Host { get; set; }

        public string Phone { get; set; }
        public string Message { get; set; }
    }
}
